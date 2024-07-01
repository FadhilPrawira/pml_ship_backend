<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // RULES
    // =====================================================================
    //     // This is assume today is 2024-05-17
    // DateTime orderDate = DateFormat("yyyy-MM-dd").parse('2024-05-17');

    // // Range for conference date is 2024-05-18 until 2024-05-20.
    // DateTime conferenceDateStarted = orderDate.add(const Duration(days: 1));
    // DateTime conferenceDateEnded = orderDate.add(const Duration(days: 3));

    // DateTime conferenceSuccessDate = DateFormat("yyyy-MM-dd").parse('2024-05-20');

    // // If conference success, customer can input document until 2 days later (2024-05-22)
    // DateTime maxInputDocument = conferenceSuccessDate.add(const Duration(days: 2));
    // DateTime customerInputDocumentShippingInstruction =
    //     DateFormat("yyyy-MM-dd").parse('2024-05-22');

    // DateTime maxPayment =
    //     customerInputDocumentShippingInstruction.add(const Duration(days: 2));
    // DateTime customerPaymentDate = DateFormat("yyyy-MM-dd").parse('2024-05-25');
    // DateTime adminCheckCustomerPaymentDate =
    //     customerPaymentDate.add(const Duration(days: 1));

    // =====================================================================

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get authenticated user
        $user = auth()->user();

        // Get all order that have status 'payment_pending' from authenticated user
        $orders = Order::where('user_id', $user->id)
            ->where('status', 'payment_pending')
            ->get();
        // Map each order to include only the necessary fields
        $ordersData = $orders->map(function ($order) {
            return [
                'transaction_id' => $order->transaction_id,
                'total_bill' => $order->total_bill,
                'status' => $order->status,
            ];
        });
        return response()->json([
            'status' => 'success',
            'message' => 'List of orders with status payment_pending',
            'data' => $ordersData,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
