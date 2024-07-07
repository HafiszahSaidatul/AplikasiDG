<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Low;
use App\Models\Pending;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class DashboardItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // @return\Iluminate\Http\Response
    // */
    public function index()
    {

        $totalPending = Pending::count();
        $totalLow = Low::count();

        $title = '';
        $lows = Low::with('item')->get();
        $pendings = Pending::with('item')->get();

        // Combine them into a single collection
        $combined = $lows->concat($pendings);

        // Manual pagination
        $perPage = 2; // Number of items per page ganti ini untuk item minimal di page
        $currentPage = Paginator::resolveCurrentPage() ?? 1;
        $currentItems = $combined->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $paginatedItems = new LengthAwarePaginator(
            $currentItems,
            $combined->count(),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath()]
        );

        return view('dashboard.index', [
            'combined' => $paginatedItems,
            "title" => "DASHBOARD",
            'active' => 'dashboard',
            "notif" => "",
            'totalLow' => $totalLow,
            'totalPending' => $totalPending,
            'total' => Item::count()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('dashboard.items.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('dashboard.index', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
