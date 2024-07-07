@extends('layouts.main')
@extends('layouts.produk')

@section('container')
    <div class="card px-3 py-4">
        <div class="mt-5 fw-bold">
            <h2 class="fw-bold">Edit Produk</h2>
            @if ($errors->any())
                <div class="text-red-50" style="color: red">{{ implode('', $errors->all(':message')) }}</div>
            @endif
            <form action="{{ route('produk.update', ['id' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3 fw-bold">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" class="form-control" id="nama_produk" name="namaproduk"
                        value="{{ $item->namaproduk }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="deskripsi_produk">Deskripsi Produk</label>
                    <textarea required class="form-control" id="deskripsi_produk" name="keterangan" rows="3">{{ $item->keterangan }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="{{ $item->harga }}"
                        required>
                </div>
                <div class="form-group mb-3">
                    <label for="foto">Foto Produk</label>
                    <input type="file" class="form-control-file" id="foto" name="image" accept="image/*">
                    @if ($item->image_path)
                        <div class="mt-2">
                            <img src="{{ asset('img/' . $item->image_path) }}" alt="Foto Produk" style="max-width: 200px;">
                        </div>
                    @endif
                </div>
                <button type="submit" class="fw-bold btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection
