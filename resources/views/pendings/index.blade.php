@extends('layouts.main')
@extends('layouts.produk')


<style>
    
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        text-decoration: none;
        list-style: none;
    }

    .pagination .page-item .page-link {
        color: #dc3545;
        background-color: transparent;
        border: 1px solid #dc3545;
        margin: 0 2px;
        padding: 6px 12px;
        text-decoration: none;

    }

    .pagination .page-item .page-link:hover {
        background-color: #dc3545;
        color: #ffffff;
        border-color: #dc3545;
    }

    .pagination .page-item.active .page-link {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #ffffff;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: transparent;
        border-color: #6c757d;
    }
</style>

@section('container')
    <div class="d-flex justify-content-end mb-3" style="margin-top: 10px">
        <button class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Tambah Pending</button>
    </div>
    <!-- Modal for Viewing Products -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Daftar Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="searchInput" class="form-control mb-3" name="key"
                        placeholder="Cari Nama Barang">
                    <ul id="productList" class="list-group">
                        @foreach ($items as $product)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $product->namaproduk }}
                                <a href="{{ route('pendings.create', ['itemId' => $product->id]) }}"
                                    class="btn btn-primary btn-sm">Pilih</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive" style="margin-top: 20px">
        <table class="table table-striped" id="pendingTable">
            <thead>
                <tr>
                    <th>GAMBAR</th>
                    <th>NAMA PRODUK</th>
                    <th>KETERANGAN</th>
                    <th>QUANTITY</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pending as $item)
                    <tr>
                        <td>
                            <img src="{{ asset('img') . '/' . $item->item->image }}" alt="image gambar" height="100px">

                        </td>
                        <td>{{ $item->item->namaproduk }}</td>
                        <td style="text-align: justify">{{ $item->description }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>
                            <a href="{{ route('pendings.edit', ['id' => $item->id]) }}" class="btn btn-sm"
                                style="text-align: justify; text-decoration: none; font-size:15px; font-weight:bold; 
                               border-radius:10px;  background-color: #edc537; color: #333; padding: 10px 20px;">
                                <i style="font-size:22px;" class="fas fa-edit"></i>
                            </a>
                            @if (auth()->user()->role == 'admin')
                                <form action="{{ route('pendings.destroy', ['id' => $item->id]) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm"
                                        style="border-radius:10px;text-align: center; text-decoration: none; 
                                        font-size:15px; font-weight:bold; background-color: #add82d; color: #333; padding: 10px 20px;"
                                        onclick="return confirm('Apakah barang sudah terpenuhi?')">
                                        <i style="font-size:22px; font-weight:580;" class="fa-regular fa-2x fa-circle-check"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                     
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <div class="d-flex justify-content-center"
        style="display: flex; justify-content: end; gap: 20px;margin-right: 100px; margin-top:20px">
        {{ $items->links() }}
    </div>



    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let query = this.value;

            fetch(`/search?key=${query}`)
                .then(response => response.json())
                .then(data => {
                    let productList = document.getElementById('productList');
                    productList.innerHTML = '';

                    data.forEach(item => {
                        let li = document.createElement('li');
                        li.className =
                            'list-group-item d-flex justify-content-between align-items-center';
                        li.innerHTML =
                            `${item.namaproduk} <a href="{{ url('pending/create') }}/${item.id}" class="btn btn-primary btn-sm">Pilih</a>`;
                        productList.appendChild(li);
                    });
                });
        });
    </script>
@endsection
