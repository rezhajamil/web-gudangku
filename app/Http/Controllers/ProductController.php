<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ddd(request()->segment(1));
        $products = Product::orderBy('code')->orderBy('brand')->orderBy('name')->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', Rule::unique(Product::class, 'code')],
            'brand' => ['required',],
            'name' => ['required', Rule::unique(Product::class, 'name')],
            'stock' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
        ]);

        $product = Product::create([
            'company_id' => auth()->user()->id,
            'code' => strtoupper($request->code),
            'brand' => ucwords($request->brand),
            'name' => ucwords($request->name),
            'stock' => $request->stock,
            'price' => $request->price,
            'status' => 1,
        ]);

        return redirect()->route('product.index')->with('success', 'Berhasil Menambahkan Barang');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'code' => ['required', Rule::unique(Product::class, 'code')->ignore($product->id)],
            'brand' => ['required',],
            'name' => ['required', Rule::unique(Product::class, 'name')->ignore($product->id)],
            'stock' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
        ]);

        $product = Product::where('id', $product->id)->update([
            'code' => strtoupper($request->code),
            'brand' => ucwords($request->brand),
            'name' => ucwords($request->name),
            'stock' => $request->stock,
            'price' => $request->price,
            'status' => 1,
        ]);

        return redirect()->route('product.index')->with('success', "Berhasil Merubah Data " . ucwords($request->name));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success', "Berhasil Menghapus Data " . ucwords($product->name));
    }

    public function change_status(Request $request)
    {
        $product = Product::find($request->id);

        $product->status = !$product->status;
        $product->save();

        return redirect()->route('product.index')->with('success', "Berhasil Ubah Status " . ucwords($product->name));
    }
}
