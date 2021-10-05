<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{

    public function index(Request $request)
    {
        $query = Currency::query();
        if($from = $request->from)
            $query->where('date','>=', $from);
        if($to = $request->to)
            $query->where('date','<=', $to);
        $currencies = $query->paginate(15)->appends(
            [
                'from' => $request->from,
                'to' => $request->to
            ]
        );

        return view('currency', compact('currencies'));
    }
}
