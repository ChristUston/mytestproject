<form method="POST" enctype="multipart/form-data">
    @csrf
    @if($method == 'edit')
        <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" class="form-control" name="kode_barang" readonly value="{{ $item->kode ?? '' }}">
        </div>
    @endif

    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama" required value="{{ $item->nama ?? '' }}">
    </div>

    <div class="form-group">
        <label>Harga Beli</label>
        <input type="number" class="form-control" name="harga_beli" required value="{{ $item->harga_beli ?? '' }}">
    </div>

    <div class="form-group">
        <label>Laba (%)</label>
        <input type="number" class="form-control" name="laba" required value="{{ $item->laba ?? '' }}">
    </div>

    <div class="form-group">
        <label>Supplier</label>
        <select class="form-control" name="supplier" required>
            @php $selected = $item->supplier ?? ''; @endphp
            <option value="">--Pilih--</option>
            <option @if($selected=='Tokopaedi') selected @endif>Tokopaedi</option>
            <option @if($selected=='Bukulapuk') selected @endif>Bukulapuk</option>
            <option @if($selected=='TokoBagas') selected @endif>TokoBagas</option>
            <option @if($selected=='E Commurz') selected @endif>E Commurz</option>
            <option @if($selected=='Blublu') selected @endif>Blublu</option>
        </select>
    </div>

    <div class="form-group">
        <label>Jenis</label>
        <select class="form-control" name="jenis" required>
            @php $selected = $item->jenis ?? ''; @endphp
            <option value="">--Pilih--</option>
            <option @if($selected=='Obat') selected @endif>Obat</option>
            <option @if($selected=='Alkes') selected @endif>Alkes</option>
            <option @if($selected=='Matkes') selected @endif>Matkes</option>
            <option @if($selected=='Umum') selected @endif>Umum</option>
            <option @if($selected=='ATK') selected @endif>ATK</option>
        </select>
    </div>

    <div class="form-group">
        <label>Foto</label>
        <input type="file" class="form-control" name="foto">
        @if(!empty($item->foto))
            <img src="{{ asset('storage/'.$item->foto) }}" alt="Foto" style="width:80px;height:80px;margin-top:5px;">
        @endif
    </div>

    <button class="btn btn-primary mt-2">Submit</button>
</form>
