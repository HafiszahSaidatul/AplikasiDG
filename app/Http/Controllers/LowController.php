<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Low;
use Illuminate\Http\Request;

class LowController extends Controller
{
    //

    public function index(Request $request)
    {

        $query = $request->query('key');

        // Default pagination untuk items
        $items = Item::query();

        if (isset($query)) {
            // Jika ada query, tambahkan kondisi pencarian
            $items = $items->where('namaproduk', 'like', '%' . $query . '%');
        }

        // Tentukan jumlah item per halaman, misalnya 10
        $items = $items->paginate(10);

        // Pagination untuk low
        $low = Low::with('item')->paginate(10);

        $title = 'LOWSTOCK';
        $active = 'data low';
        return view('lows.index', compact('low', 'title', 'active', 'items'));
    }

    public function create($itemId)
    {

        $title = 'TAMBAH PRODUK LOWSTOCK';
        $active = 'items';
        $item = Item::where('id', $itemId)->first();
        return view('lows.create', compact('title', 'active', 'item'));
    }

    public function store(Request $request, $itemId)
    {


        $request->validate([
            'quantity' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if (Low::where('item_id', $itemId)->exists()) {
            return back()->withErrors('Telah Dimasukan Sebagai Barang Low.');
        }

        Low::create([
            'quantity' => $request->quantity,
            'description' => $request->description,
            'item_id' => $itemId,
        ]);

        return redirect()->route('lows.index')->with('success', 'low berhasil ditambahkan!');
    }

    public function show($id)
    {
        $low = Low::findOrFail($id);
        return view('lows.show', compact('low'));
    }

    public function edit($id)
    {
        $low = Low::findOrFail($id);
        $title = 'EDIT LOWSTOCK';
        $active = 'items';
        return view('lows.edit', compact('low', 'title', 'active'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $low = Low::findOrFail($id);
        $low->update([
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        return redirect()->route('lows.index')->with('success', 'Lowstock berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $low = Low::findOrFail($id);
        $low->delete();

        return redirect()->route('lows.index')->with('success', 'Lowstock berhasil dihapus!');
    }
}
