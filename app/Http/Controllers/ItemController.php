<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{

    public function index(Request $request)
    {
        $title = 'PRODUK';
        $query = $request->query('search');

        if (isset($query)) {
            $itemsAll = Item::where('namaproduk', 'like', '%' . $query . '%')->paginate(5); // 10 items per page
        } else {
            $itemsAll = Item::paginate(5); // 10 items per page
        }

        return view('item_admin', [
            "title" =>  $title,
            'active' => 'items',
            "items" => $itemsAll
        ]);
    }


    public function show(Item $item)
    {
        return view('item', [
            "title" => "DETAIL PRODUK",
            'active' => 'items',
            "item" => $item
        ]);
    }

    public function create()
    {
        $title = 'TAMBAH PRODUK';
        $active = 'items';
        return view('tambah_produk', compact('title', 'active'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaproduk' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // maksimum 2MB
        ]);

        // // Mengambil file gambar jika ada dan menyimpannya di dalam folder public/img
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time() . '_' . $image->getClientOriginalName();
        //     $image->move(public_path('img'), $imageName); // simpan gambar di dalam folder public/img
        // } else {
        //     $imageName = null; // default jika tidak ada gambar yang diunggah
        // }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            try {
                $image->move(public_path('img'), $imageName); // simpan gambar di dalam folder public/img
            } catch (\Exception $e) {
                \Log::error('Image upload error: ' . $e->getMessage());
                return back()->with('error', 'Error uploading image.');
            }
        } else {
            $imageName = null; // default jika tidak ada gambar yang diunggah
        }
        


        // Menyimpan data item ke dalam database
        $item = new Item();
        $item->namaproduk = $request->namaproduk;
        $item->keterangan = $request->keterangan;
        $item->harga = $request->harga;
        // $item->quantity =  $request->quantity;
        $item->user_id = auth()->user()->id;
        $item->image = $imageName; // simpan nama file gambar ke dalam kolom image_path
        $item->save();

        // Redirect dengan flash message jika berhasil disimpan
        return redirect()->route('produk.index')->with('success', 'Item berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $title = 'EDIT PRODUK';
        $active = 'items';

        return view('edit_produk', compact('title', 'active', 'item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namaproduk' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // maksimum 2MB
        ]);

        $item = Item::findOrFail($id);

        // Mengambil file gambar jika ada dan menyimpannya di dalam folder public/img
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('img'), $imageName); // simpan gambar di dalam folder public/img
            // Hapus file gambar lama jika ada
            
            // if ($item->image) {
            //     unlink(public_path('img') . '/' . $item->image_path);
            // }
            $item->image = $imageName;
        }

        $item->namaproduk = $request->namaproduk;
        $item->keterangan = $request->keterangan;
        $item->harga = $request->harga;
        // $item->quantity = $request->quantity;
        $item->save();

        return redirect()->route('produk.index')->with('success', 'Item berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $item = Item::where('id', $id)->first();
        $item->delete();
        return redirect()->route('produk.index')->with('success', 'Item berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $key = $request->input('key');
        $items = Item::where('namaproduk', 'like', "%{$key}%")->get();

        return response()->json($items);
    }
}
