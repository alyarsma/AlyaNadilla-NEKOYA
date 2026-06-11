@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-white px-6 pt-28 pb-16 text-slate-900 dark:bg-slate-950 dark:text-white">
    <div class="mx-auto max-w-3xl rounded-3xl border border-cyan-400/30 bg-slate-100 p-8 shadow-xl dark:bg-slate-900">
        <h1 class="text-3xl font-bold">
            Pengaturan <span class="text-pink-400">Preferensi</span>
        </h1>

        <form id="preferenceForm" class="mt-8 space-y-6">
            @csrf

            <div>
                <label class="mb-2 block font-semibold">Pilihan Tema</label>
                <select id="theme" name="theme" class="w-full rounded-xl px-4 py-3 text-slate-900">
                    <option value="light">Light</option>
                    <option value="dark">Dark</option>
                    <option value="system">System</option>
                </select>
            </div>

            <div>
                <label class="mb-2 block font-semibold">Ukuran Font</label>
                <select id="font_size" name="font_size" class="w-full rounded-xl px-4 py-3 text-slate-900">
                    <option value="small">Kecil</option>
                    <option value="normal">Normal</option>
                    <option value="large">Besar</option>
                </select>
            </div>

            <button type="submit" class="rounded-full bg-pink-500 px-6 py-3 font-semibold text-white hover:bg-cyan-400">
                Simpan Preferensi
            </button>
        </form>

        <p id="preferenceMessage" class="mt-4 font-semibold text-cyan-400"></p>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("preferenceForm");
    const message = document.getElementById("preferenceMessage");

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch("{{ route('preferensi.store') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                "X-Requested-With": "XMLHttpRequest",
                "Accept": "application/json"
            },
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                message.textContent = result.message;

                if (result.data.theme === "dark") {
                    document.documentElement.classList.add("dark");
                } else if (result.data.theme === "light") {
                    document.documentElement.classList.remove("dark");
                } else {
                    const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
                    document.documentElement.classList.toggle("dark", prefersDark);
                }

                document.documentElement.classList.remove("text-sm", "text-base", "text-lg");

                if (result.data.font_size === "small") {
                    document.documentElement.classList.add("text-sm");
                } else if (result.data.font_size === "large") {
                    document.documentElement.classList.add("text-lg");
                } else {
                    document.documentElement.classList.add("text-base");
                }
            }
        });
    });
});
</script>
@endsection
