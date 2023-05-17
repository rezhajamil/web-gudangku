<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::count();
        $distributor = Distributor::count();
        $stock_in = Transaction::where('type', 'in')->whereMonth('date', date('m'))->count();
        $stock_out = Transaction::where('type', 'out')->whereMonth('date', date('m'))->count();

        return view('home', compact('product', 'distributor', 'stock_in', 'stock_out'));
    }
}
