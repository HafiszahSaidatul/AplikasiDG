@extends('layouts.main')
@extends('layouts.produk')

@section('container')
    <div class="card px-3 py-4">

        <div class="mt-3 fw-bold">
            <h2 class="text-center fw-bold">Tambah Produk</h2>
            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" class="form-control" id="nama_produk" name="namaproduk" required>
                </div>
                <div class="form-group mb-3">
                    <label for="deskripsi_produk">Deskripsi Produk</label>
                    <textarea required class="form-control" id="deskripsi_produk" name="keterangan" rows="3"></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="deskripsi_produk">Harga</label>
                    <input required type="number" class="form-control" id="deskripsi_produk" name="harga"
                        rows="3"></input>
                </div>
                <div class="form-group mb-3">
                    <label for="foto">Foto Produk</label>
                    <input type="file" class="form-control-file" id="foto" name="image" accept="image/*">
                </div>
                <button type="submit" class="fw-bold btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
