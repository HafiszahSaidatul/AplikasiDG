@extends('layouts.main')


<style>
    table {
        max-width: 95%;
    }

    .table-container {
        justify-content: center;
        display: flex
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
</style>

@section('container')
    @if (auth()->user()->role == 'admin')
        <div class="card--container">
            <div class="card--wrapper">
                <div class="payment--card light-red">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">TOTAL PRODUK</span>
                            <h2 class="amount-value">{{ $total }}</h2>
                        </div>
                        <i class="fas fa-briefcase fa-3x icon dark-blue"></i>
                    </div>
                    <span class="card-detail">{{ $notif }}</span>
                </div>

                <div class="payment--card light-red">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">TOTAL PENDING</span>
                            <h2 class="amount-value">{{ $totalPending }}</h2>
                        </div>
                        <i class="fas fa-clock fa-3x icon dark-green"></i>
                    </div>
                    <span class="card-detail">{{ $notif }}</span>
                </div>

                <div class="payment--card light-red">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">TOTAL  LOWSTOCK</span>
                            <h2 class="amount-value">{{ $totalLow }}</h2>
                        </div>
                        <i class="fas fa-exclamation-circle fa-3x icon dark-purple"></i>
                    </div>
                    <span class="card-detail">{{ $notif }}</span>
                </div>
            </div>
        </div>
    @endif

    <div class="tabular--wrapper">
        <h3 class="main--title">Data Barang Pending & Lowstock</h3>
        <div class="table-container">
            <table class="table">
                <thead style="background-color: #be2623">
                    <tr style="background-color: #be2623">
                        <th>GAMBAR</th>
                        <th>NAMA PRODUK</th>
                        <th>KETERANGAN</th>
                        <th>QUANTITY</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($combined as $item)
                        <tr>
                            <td>
                                <img src="{{ asset('img') . '/' . $item->item->image }}" alt="image gambar" height="100px">
                            </td>
                            <td>{{ $item->item->namaproduk }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                @if ($item->getTable() == 'low')
                                    <span class="badge bg-warning"
                                        style="padding: 10px 15px; background-color: #f3ce49;  color: #333;border-radius: 10px">LOWSTOCK</span>
                                @else
                                    <span class="badge bg-danger"
                                        style="padding: 10px 15px; background-color: #e23330;; color: white;border-radius: 10px">PENDING</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="d-flex justify-content-center" style="display: flex; justify-content: end; gap: 20px">
            {{ $combined->links() }}
        </div>
    </div>
@endsection
