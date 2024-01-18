<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return response()->json([
            'categories' => $product
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'description' => 'required',
            'harga' => 'required',
            'category_id' => 'required',
            'img' => 'required|mimes:png,jpg,jpeg'
        ]);
        $img_path = '';
        if ($request->hasFile('img')) {
            $img_path = $request->file('img')->store('product', 'public');
        }

        $product = Product::create([
            'nama' => $request->nama,
            'description' => $request->description,
            'harga' => $request->harga,
            'category_id' => $request->category_id,
            'img' => $img_path
        ]);
        return response()->json([
            'products' => $product,
            'msg' => 'data berhasil disimpan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'description' => 'required',
            'harga' => 'required',
            'category_id' => 'required',
            'img' => 'required|mimes:png,jpg,jpeg'
        ]);
        $img_path = '';
        if ($request->hasFile('img')) {
            $img_path = $request->file('img')->store('product', 'public');
        }
        $product = Product::find($id);
        $product->update([
            'nama' => $request->nama,
            'description' => $request->description,
            'harga' => $request->harga,
            'category_id' => $request->category_id,
            'img' => $img_path
        ]);

        return response()->json([
            'products' => $product,
            'msg' => 'data berhasil disimpan'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id)->delete();
        return response()->json([
            'product' => $product
        ]);
    }
}
