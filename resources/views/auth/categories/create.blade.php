@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Kategori</h3>

    <a href="{{ url('categories') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Kategori</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('categories/store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kode" class="form-label">Kode Kategori</label>
            <input type="text" name="kode" id="kode" class="form-control" value="{{ old('kode') }}" required>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kategori</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
