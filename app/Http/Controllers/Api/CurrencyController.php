<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Currency;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get currency data
        $currency_data = Currency::find(1);

        return response()->json([
            'status' => 'success',
            'message' => 'Get currency data success',
            'data' => $currency_data
        ])->setStatusCode(200);
    }
}
