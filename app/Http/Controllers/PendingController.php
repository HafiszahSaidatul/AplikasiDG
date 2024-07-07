<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Pending;
use Illuminate\Http\Request;

class PendingController extends Controller
{
    //

    public function index(Request $request)
    {

        $query = $request->query('key');

        $items = Item::query();

        if (isset($query)) {
            $items = $items->where('namaproduk', 'like', '%' . $query . '%');
        }
        $items = $items->paginate(10);

        $pending = Pending::with('item')->paginate(10);
        $title = 'PENDING';
        $active = 'data pending';
        return view('pendings.index', compact('pending', 'title', 'active', 'items'));
    }

    public function create($itemId)
    {

        $title = 'TAMBAH PRODUK PENDING';
        $active = 'items';
        $item = Item::where('id', $itemId)->first();
        return view('pendings.create', compact('title', 'active', 'item'));
    }

    public function store(Request $request, $itemId)
    {


        $request->validate([
            'quantity' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if (Pending::where('item_id', $itemId)->exists()) {
            return back()->withErrors('Telah Dimasukan Sebagai Barang Pending');
        }

        Pending::create([
            'quantity' => $request->quantity,
            'description' => $request->description,
            'item_id' => $itemId,
        ]);

        return redirect()->route('pendings.index')->with('success', 'Pending berhasil ditambahkan!');
    }

    public function show($id)
    {
        $pending = Pending::findOrFail($id);
        return view('pendings.show', compact('pending'));
    }

    public function edit($id)
    {
        $pending = Pending::findOrFail($id);
        $title = 'EDIT PENDING';
        $active = 'items';
        return view('pendings.edit', compact('pending', 'title', 'active'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $pending = Pending::findOrFail($id);
        $pending->update([
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        return redirect()->route('pendings.index')->with('success', 'Pending berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pending = Pending::findOrFail($id);
        $pending->delete();

        return redirect()->route('pendings.index')->with('success', 'Pending berhasil dihapus!');
    }
}
