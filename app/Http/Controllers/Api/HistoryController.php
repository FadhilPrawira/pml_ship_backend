<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        $order = Order::with(['portOfLoading', 'portOfDischarge', 'vesselName'])
            ->where('user_id', $user->id)
//            order by created_at desc
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'data' => $order
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


}
