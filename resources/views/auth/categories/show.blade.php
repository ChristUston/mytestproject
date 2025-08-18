@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Detail Kategori</h3>

    <a href="{{ url('categories') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Kategori</a>

    <div class="card mb-3">
        <div class="card-header">Informasi Kategori</div>
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tr>
                    <th>Kode</th>
                    <td>{{ $category->kode }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $category->nama }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Daftar Item dalam Kategori "{{ $category->nama }}"</div>
        <div class="card-body">
            @if($category->items->isEmpty())
                <p>Tidak ada item dalam kategori ini.</p>
            @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Supplier</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category->items as $item)
                    <tr>
                        <td>{{ $item->kode }}</td>
                        <td>
                            @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}" alt="Foto" style="width:50px;height:50px;">
                            @else
                                <span style="color:red">No Foto</span>
                            @endif
                        </td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jenis }}</td>
                        <td>{{ $item->harga_beli }}</td>
                        <td>{{ round($item->harga_beli + $item->harga_beli * $item->laba / 100) }}</td>
                        <td>{{ $item->supplier }}</td>
                        <td>
                            <a href="{{ url('master-items/view/'.$item->kode) }}" class="btn btn-primary btn-sm">View</a>
                            <a href="{{ url('master-items/form/edit/'.$item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection
