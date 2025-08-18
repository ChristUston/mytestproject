@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Kategori</h3>

    <form class="row g-2 mb-3">
        <div class="col-auto">
            <input type="text" name="nama" value="{{ request('nama') }}" class="form-control" placeholder="Filter Nama">
        </div>
        <div class="col-auto">
            <input type="text" name="kode" value="{{ request('kode') }}" class="form-control" placeholder="Filter Kode">
        </div>
        <div class="col-auto">
            <button class="btn btn-primary">Filter</button>
        </div>
        <div class="col-auto">
            <a href="{{ url('categories/create') }}" class="btn btn-success">Tambah Kategori</a>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $cat)
            <tr>
                <td>{{ $cat->kode }}</td>
                <td>{{ $cat->nama }}</td>
                <td>
                    <a href="{{ url('categories/'.$cat->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ url('categories/'.$cat->id.'/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{ url('categories/'.$cat->id.'/delete') }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
