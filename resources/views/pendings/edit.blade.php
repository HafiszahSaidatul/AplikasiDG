@extends('layouts.main')
@extends('layouts.produk')

@section('container')
    <div class="card px-3 py-4">
        <div class="mt-5 fw-bold">
            <h2 class="fw-bold">Edit Pending</h2>
            @if ($errors->any())
                <div class="text-red-50" style="color: red">{{ implode('', $errors->all(':message')) }}</div>
            @endif
            <form action="{{ route('pendings.update', ['id' => $pending->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Gunakan method PUT untuk update --}}
                <div class="form-group mb-3">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" value="{{ $pending->item->namaproduk }}" readonly class="form-control"
                        id="nama_produk" name="item_id" required>
                </div>
                <div class="form-group mb-3">
                    <label for="quantity">Quantity</label>
                    <input type="number" value="0" readonly class="form-control"  class="form-control" id="quantity" name="quantity"
                        value="{{ $pending->quantity }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="deskripsi_produk">Description</label>
                    <textarea required class="form-control" id="deskripsi_produk" name="description" rows="3">{{ $pending->description }}</textarea>
                </div>
                <button type="submit" class="fw-bold btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection
