<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transactions = Transaction::with(['company', 'user', 'product', 'distributor'])->where('type', 'in');

        if ($request->start_date) {
            $transactions->whereDate('date', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $transactions->whereDate('date', '<=', $request->end_date);
        }

        $transactions = $transactions->orderBy('date', 'desc')->get();

        return view('stockIn.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::orderBy('brand')->orderBy('name')->where('status', 1)->get();
        $distributors = Distributor::orderBy('name')->get();

        return view('stockIn.create', compact('products', 'distributors'));
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
            'distributor' => ['required'],
            'amount' => ['required', 'numeric', 'min:1'],
            'price' => ['required', 'numeric', 'min:1'],
            'date' => ['required'],
        ]);

        $user = auth()->user();

        $stock_in = Transaction::create([
            'company_id' => $user->role == 'company' ? $user->id : $user->company_id,
            'user_id' => $user->id,
            'product_id' => $request->product,
            'distributor_id' => $request->distributor,
            'type' => 'in',
            'price' => $request->price,
            'amount' => $request->amount,
            'date' => $request->date,
        ]);

        $product = Product::find($request->product);
        $product->stock += $request->amount;
        $product->save();

        return redirect()->route('stock_in.index')->with('success', 'Berhasil Menambahkan Data Barang Masuk');
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
    public function edit($id)
    {
        $products = Product::orderBy('brand')->orderBy('name')->where('status', 1)->get();
        $distributors = Distributor::orderBy('name')->get();
        $transaction = Transaction::find($id);
        // ddd($transaction);
        return view('stockIn.edit', compact('transaction', 'products', 'distributors'));
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
            'distributor' => ['required'],
            'amount' => ['required', 'numeric', 'min:1'],
            'price' => ['required', 'numeric', 'min:1'],
            'date' => ['required'],
        ]);

        $transaction = Transaction::find($id);

        if ($transaction->product_id != $request->product) {
            $product_old = Product::find($transaction->product_id);
            $product_new = Product::find($request->product);
            // ddd([$product_old, $product_new]);
            $product_old->stock -= $transaction->amount;
            $product_new->stock += $request->amount;

            $product_old->save();
            $product_new->save();
        } else {
            $product = Product::find($transaction->product_id);
            $product->stock = ($product->stock - $transaction->amount) + $request->amount;
            $product->save();
        }

        $transaction->product_id = $request->product;
        $transaction->distributor_id = $request->distributor;
        $transaction->amount = $request->amount;
        $transaction->price = $request->price;
        $transaction->date = $request->date;
        $transaction->save();

        return redirect()->route('stock_in.index')->with('success', 'Berhasil Merubah Data Barang Masuk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        $product = Product::find($transaction->product_id);

        $product->stock -= $transaction->amount;
        $product->save();

        $transaction->delete();

        return back()->with('success', 'Berhasil Menghapus Data Barang Masuk');
    }
}
