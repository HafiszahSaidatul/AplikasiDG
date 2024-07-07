@extends('layouts.main')

@section('container')
    <div class="header-content">
        @if (auth()->user()->role == 'admin')
            <div style="padding-left:90px;" class="d-flex justify-content-end mb-3">
                <a href="{{ route('produk.create') }}" class="btn btn-primary text-decoration-none"
                    style="text-decoration: none; font-size:18px; font-weight:600;">
                    <i style="font-size:20px;" class="fas fa-plus"></i> Tambah Produk
                </a>
            </div>
        @endif

        <div class="custom-search-container">
            <div class="custom-search-wrapper">
                <div class="custom-search-form">
                    <form action="/produk" method="GET"
                        class="custom-search-form-inner shadow-sm p-3 mb-5 bg-body rounded">
                        <div class="custom-input-group">
                            <input type="text" class="custom-form-control" placeholder="Cari" name="search"
                                value="{{ request('search') }}">
                            <button class="" style="background-color: transparent" type="submit">
                                <i style="font-size:20px; color:#be2623; font-weight:bold" class="fas fa-search fa-lg"></i>
                            </button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="text-red-50" style="color: red">{{ implode('', $errors->all(':message')) }}</div>
    @endif

    <div class="table-responsive" style="margin-top: 20px">
        <table class="table table-striped" id="produkTable">
            <thead>
                <tr>
                    <th>GAMBAR</th>
                    <th>NAMA PRODUK</th>
                    <th>DESKRIPSI</th>
                    <th>HARGA</th>
                   
                    @if (auth()->user()->role == 'admin')
                        <th >Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $p)
                    <tr>
                        <td>
                            <img src="{{ asset('img') . '/' . $p->image }}" alt="image gambar" height="100px">
                        </td>
                        <td style="text-align: justify">{{ $p->namaproduk }}</td>
                        <td style="text-align: justify">{{ $p->keterangan }}</td>
                        <td >{{ number_format($p->harga) }}</td>
                        {{-- <td>{{ $p->quantity }}</td> --}}
                        @if (auth()->user()->role == 'admin')
                            <td
                                style="display: flex; justify-content: center;gap:10px; align-items: center; margin-top:20px;">
                                <a href="{{ route('produk.edit', ['id' => $p->id]) }}"
                                    class="btn btn-primary text-decoration-none"
                                    style="text-align: center; text-decoration: none;  font-size:13px; background-color:#edc537; color: #333; font-weight:bold; padding: 10px 20px;">
                                    <i class="fas fa-pencil"></i> 
                                </a>
                                <form action="{{ route('produk.destroy', ['id' => $p->id]) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary text-decoration-none"
                                        style="text-align: center; text-decoration: none;  font-size:13px; background-color: #990808; font-weight:bold; padding: 10px 20px;"
                                        onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="fas fa-trash-alt"></i> 
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tampilkan pagination -->

    </div>
    <div class="d-flex justify-content-center"
        style="display: flex; justify-content: end; gap: 20px;margin-right: 100px; margin-top:20px">
        {{ $items->links() }}
    </div>
@endsection

@push('styles')
    <style>
        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between
        }

        .custom-search-container {
            margin-top: 20px;
            padding: 0 15px;
        }

        /* Wrapper styling */
        .custom-search-wrapper {
            display: flex;
            justify-content: center;
        }

        /* Form styling */
        .custom-search-form {
            background-color: #ffffff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 15px;
            width: 100%;
            max-width: 500px;
            align-items: center;
        }

        /* Input group styling */
        .custom-input-group {
            flex: 1;
            display: flex;
            justify-content: space-between
        }

        /* Text input styling */
        .custom-form-control {
            flex: 1;
            border: none;
            padding: 8px;
            font-size: 16px;
            border-radius: 4px 0 0 4px;
        }

        .custom-btn {
            background-color: #dc3545;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 0 4px 4px 0;
        }

        .custom-btn:hover {
            background-color: #c82333;
        }

        .table-responsive {
            margin-top: 20px;
        }

        .badge {
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 12px;
        }

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


        table {
            max-width: 90%;
        }

        .table-responsive {
            justify-content: center;
            display: flex
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#produkTable').DataTable();
        });
    </script>
@endpush
