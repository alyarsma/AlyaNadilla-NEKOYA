@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Costume</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('costumes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label>Kode Costume</label><br>
            <input type="text" name="kode_costume" value="{{ old('kode_costume') }}">
        </div>

        <br>

        <div>
            <label>Nama Costume</label><br>
            <input type="text" name="nama_kostum" value="{{ old('nama_kostum') }}">
        </div>

        <br>

        <div>
            <label>Kategori</label><br>
            <select name="kategori">
                <option value="">-- Pilih Kategori --</option>
                <option value="Anime" {{ old('kategori') == 'Anime' ? 'selected' : '' }}>Anime</option>
                <option value="Game" {{ old('kategori') == 'Game' ? 'selected' : '' }}>Game</option>
                <option value="Movie" {{ old('kategori') == 'Movie' ? 'selected' : '' }}>Movie</option>
                <option value="Original" {{ old('kategori') == 'Original' ? 'selected' : '' }}>Original</option>
            </select>
        </div>

        <br>

        <div>
            <label>Ukuran</label><br>
            <select name="ukuran">
                <option value="">-- Pilih Ukuran --</option>
                <option value="S" {{ old('ukuran') == 'S' ? 'selected' : '' }}>S</option>
                <option value="M" {{ old('ukuran') == 'M' ? 'selected' : '' }}>M</option>
                <option value="L" {{ old('ukuran') == 'L' ? 'selected' : '' }}>L</option>
                <option value="XL" {{ old('ukuran') == 'XL' ? 'selected' : '' }}>XL</option>
            </select>
        </div>

        <br>

        <div>
            <label>Harga Sewa</label><br>
            <input type="number" name="harga_sewa" value="{{ old('harga_sewa') }}">
        </div>

        <br>

        <div>
            <label>Stok</label><br>
            <input type="number" name="stok" value="{{ old('stok') }}">
        </div>

        <br>

        <div>
            <label>Foto Costume</label><br>
            <input type="file" name="foto">
        </div>

        <br>

        <button type="submit">Simpan</button>
        <a href="{{ route('costumes.index') }}">Kembali</a>
    </form>
</div>
@endsection
