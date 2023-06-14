<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Rules\InStock;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transactions = Transaction::where('company_id', auth()->user()->role == 'company' ? auth()->user()->id : auth()->user()->company_id)->with(['company', 'user', 'product', 'distributor'])->where('type', 'out');

        if ($request->start_date) {
            $transactions->whereDate('date', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $transactions->whereDate('date', '<=', $request->end_date);
        }

        $transactions = $transactions->orderBy('date', 'desc')->get();

        return view('stockOut.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::orderBy('brand')->orderBy('name')->where('status', 1)->get();


        return view('stockOut.create', compact('products'));
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
            'product' => ['required'],
            'name' => ['required'],
            'date' => ['required'],
        ]);

        $product = Product::find($request->product);

        $request->validate([
            'amount' => ['required', 'numeric', 'min:1', new InStock($request->amount, $product->stock)],
        ]);

        $user = auth()->user();


        $stock_out = Transaction::create([
            'company_id' => $user->role == 'company' ? $user->id : $user->company_id,
            'user_id' => $user->id,
            'product_id' => $request->product,
            'name' => $request->name,
            'type' => 'out',
            'price' => $product->price,
            'amount' => $request->amount,
            'date' => $request->date,
        ]);

        $product->stock -= $request->amount;
        $product->save();

        return redirect()->route('stock_out.index')->with('success', 'Berhasil Menambahkan Data Barang Keluar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction, $id)
    {
        $products = Product::orderBy('brand')->orderBy('name')->where('status', 1)->get();
        $transaction = Transaction::find($id);
        // ddd($transaction);
        return view('stockOut.edit', compact('transaction', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product' => ['required'],
            'name' => ['required'],
            'date' => ['required'],
        ]);

        $transaction = Transaction::find($id);


        if ($transaction->product_id != $request->product) {
            $product_old = Product::find($transaction->product_id);
            $product = Product::find($request->product);

            $request->validate([
                'amount' => ['required', 'numeric', 'min:1', new InStock($request->amount, $product->stock)],
            ]);

            $product_old->stock += $transaction->amount;
            $product->stock -= $request->amount;

            $product_old->save();
            $product->save();
        } else {
            $product = Product::find($transaction->product_id);

            $request->validate([
                'amount' => ['required', 'numeric', 'min:1', new InStock($request->amount, ($product->stock + $transaction->amount))],
            ]);

            $product->stock = ($product->stock + $transaction->amount) - $request->amount;
            $product->save();
        }

        $transaction->product_id = $request->product;
        $transaction->name = $request->name;
        $transaction->amount = $request->amount;
        $transaction->price = $product->price;
        $transaction->date = $request->date;
        $transaction->save();

        return redirect()->route('stock_out.index')->with('success', 'Berhasil Merubah Data Barang Keluar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
