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
        $product = Product::where('company_id', auth()->user()->role == 'company' ? auth()->user()->id : auth()->user()->company_id)->count();
        $distributor = Distributor::where('company_id', auth()->user()->id)->count();
        $stock_in = Transaction::where('company_id', auth()->user()->role == 'company' ? auth()->user()->id : auth()->user()->company_id)->where('type', 'in')->whereMonth('date', date('m'))->count();
        $stock_out = Transaction::where('company_id', auth()->user()->role == 'company' ? auth()->user()->id : auth()->user()->company_id)->where('type', 'out')->whereMonth('date', date('m'))->count();

        return view('home', compact('product', 'distributor', 'stock_in', 'stock_out'));
    }
}
