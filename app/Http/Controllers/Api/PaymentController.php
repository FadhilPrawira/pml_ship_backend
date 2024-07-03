<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentOptionsResource;
use App\Models\Document;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Illuminate\Http\Request;
use stdClass;

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
    public function index(Request $request)
    {
        // Validate the request
        $request->validate([
            // This is based on migration status enum
            'status' => 'string|in:pending,approved,rejected',
        ]);

        // 'Order by' different at different status
        // Example: 'Order by' created_at for 'pending' status, 'Order by' approved_at for 'approved' status, 'Order by' rejected_at for 'rejected' status
        // if ($request->status == 'order_pending') {
        //     $orderByRule = 'created_at';
        // } else if ($request->status == 'payment_pending') {
        //     $orderByRule = 'negotiation_or_order_approved_at';
        // } else if ($request->status == 'on_shipping') {
        //     $orderByRule = 'updated_at'; // not sure
        // } else if ($request->status == 'order_completed') {
        //     $orderByRule = 'updated_at'; // not sure
        // } else if ($request->status == 'order_canceled') {
        //     $orderByRule = 'order_canceled_at';
        // } else if ($request->status == 'order_rejected') {
        //     $orderByRule = 'order_rejected_at';
        // } else {
        //     $orderByRule = 'created_at';
        // }



        // Get the payments
        $payments = Payment::where('payment_status', 'like', "%{$request->status}%")
            ->orderBy('created_at', 'desc')
            ->get();



        if ($payments->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Payments with status ' . $request->status . ' not found',
                'data' => []
            ])->setStatusCode(404);
        }
        return response()->json([
            'status' => 'success',
            'message' => $request->has('status') ? 'Get all payments by status ' . $request->status . ' success' : 'Get Payments list success',
            'data' => $payments,
        ])->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate data
        $request->validate([
            'transaction_id' => 'required|string',
            'payment_amount' => 'required|numeric',
            'total_installments' => 'required|numeric',
        ]);

        // Get all request data
        $data = $request->all();

        // Check if the order exists
        $order = Order::where('transaction_id', $data['transaction_id'])->first();

        // If order does not exist, return error
        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Transaction not found',
                'data' => null,
            ])->setStatusCode(404);
        }

        // Check if already have payment with the same order_transaction_id
        $payment = Payment::where('order_transaction_id', $data['transaction_id'])->first();

        // If exist, error
        if ($payment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Payment already exists',
                'data' => null,
            ])->setStatusCode(400);
        }


        // Set installment_number to 1
        $data['installment_number'] = 1;
        // Set status to pending
        $data['payment_status'] = 'pending';


        // Read the 'shipping_instruction' uploaded date
        $shippingInstructionDocument = Document::where('order_transaction_id', $data['transaction_id'])
            ->where('document_type', 'shipping_instruction')
            ->first();

        // Store the date in variable
        $shippingInstructionDocumentUploadedAt = $shippingInstructionDocument['uploaded_at'];

        // Set payment due date, add 2 days from shipping_instruction uploaded date
        $paymentDueDate = Carbon::parse($shippingInstructionDocumentUploadedAt)->addDays(2)->endOfDay()->format('Y-m-d H:i:s');


        // Create new payment
        $payment = Payment::create([
            'order_transaction_id' => $data['transaction_id'],
            'payment_due_date' => $paymentDueDate,
            'payment_amount' => $data['payment_amount'],
            'installment_number' => $data['installment_number'],
            'total_installments' => $data['total_installments'],
            'payment_status' => $data['payment_status'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Payment created',
            'data' => $payment,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $transactionId)
    {
        // return Payment::with('order')->where('order_transaction_id', $transactionId)->first();
    }

    public function getPaymentOptions(string $transactionId)
    {
        $order = Order::where('transaction_id', $transactionId)->first();

        $totalBill = $order->total_bill;

        // Calculate payment options with rounding
        $payAllAtOnce = $totalBill;

        $payIn2Times = [
            'firstPayment' => round(($totalBill / 2), 2),
            'secondPayment' => round(($totalBill / 2), 2)
        ];
        // Adjust the last payment to account for any rounding differences
        $payIn2Times['secondPayment'] += round($totalBill - ($payIn2Times['firstPayment'] * 2), 2);

        $payIn3Times = [
            'firstPayment' => round(($totalBill / 3), 2),
            'secondPayment' => round(($totalBill / 3), 2),
            'thirdPayment' => round(($totalBill / 3), 2)
        ];
        // Adjust the last payment to account for any rounding differences
        $payIn3Times['thirdPayment'] += round($totalBill - ($payIn3Times['firstPayment'] * 3), 2);

        $paymentOptions = [
            'payAllAtOnce' => [
                'total' => $payAllAtOnce,
            ],
            'payIn2Times' => $payIn2Times,
            'payIn3Times' => $payIn3Times,
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Payment options found',
            'data' => new PaymentOptionsResource($paymentOptions),
        ]);
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


    // Upload payment proof
    public function uploadPaymentProof(string $transactionId, Request $request)
    {
        // Validate the request
        $request->validate([
            'document_file' => ['required', File::types(['pdf'])],
        ]);

        // Get the document detail by transaction_id and document_type
        $payment_detail = Payment::where('order_transaction_id', $transactionId)
            // ->where('document_type', $request->document_type)
            ->first();

        // Get all request data
        $data = $request->all();

        // Check if the form-data request has 'document_file' as key
        if ($request->hasFile('document_file')) {

            // Store the file in variable
            $new_document_file = $request->file('document_file');

            // Set file name
            $new_document_filename = $transactionId . '-payment-proof.' . $new_document_file->extension();

            // Delete the old document_name file if it exists
            if ($payment_detail->payment_proof_document) {
                // path to the company_akta file
                $old_document_path = 'public/documents/' . $payment_detail->payment_proof_document;
                Storage::delete($old_document_path);
            }

            // Store the new file
            $new_document_file->storeAs('public/documents', $new_document_filename);
            // Access file
            // http://10.104.220.16:8000/storage/documents/TRX1717142358-shipping_instruction.pdf

        } else {
            // If the request does not have 'document_file' key
            // Set the document_name file to the old document_name file
            $new_document_file = $payment_detail->payment_proof_document;
        }

        // Update the document_detail
        $payment_detail->update([
            'payment_proof_document' => $new_document_filename,
            'payment_date' => Carbon::now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Document updated.',
            'data' => $payment_detail,
        ])->setStatusCode(200);
    }

    public function rejectPayment(string $transactionId, Request $request)
    {
        // Validate the request
        $request->validate([
            'rejected_at' => 'required|date',
        ]);

        // Get the conference
        $payment = Payment::where('order_transaction_id', $transactionId)->first();

        // Check if the conference exists
        if (!$payment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Payment not found',
                'data' => new stdClass(), // return empty object
            ])->setStatusCode(404);
        }

        // Check if the status is pending
        if ($payment->payment_status != 'pending') {
            return response()->json([
                'status' => 'error',
                'message' => 'Payment status is not pending',
                'data' => $payment,
            ])->setStatusCode(400);
        }

        // Change the status to 'rejected'
        $payment->payment_status = "rejected";
        $payment->rejected_at = Carbon::parse($request->rejected_at)->format('Y-m-d H:i:s');
        $payment->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Payment rejected.',
            'data' => $payment,
        ])->setStatusCode(200);
    }

    public function approvePayment(string $transactionId, Request $request)
    {
        // Validate the request
        $request->validate([
            'approved_at' => 'required|date',
        ]);

        // Get the conference
        $payment = Payment::where('order_transaction_id', $transactionId)->first();

        // Check if the conference exists
        if (!$payment) {
            return response()->json([
                'status' => 'error',
                'message' => 'payment not found',
                'data' => new stdClass(), // return empty object
            ], 404);
        }

        // Check if the status is pending
        if ($payment->payment_status != 'pending') {
            return response()->json([
                'status' => 'error',
                'message' => 'payment status is not pending',
                'data' => $payment,
            ], 400);
        }
        // Change the status to 'approved'
        $payment->payment_status = "approved";
        // Set the approved date
        $payment->approved_at = Carbon::parse($request->approved_at)->format('Y-m-d H:i:s');
        $payment->save();

        return response()->json([
            'status' => 'success',
            'message' => 'payment approved.',
            'data' => $payment,
        ])->setStatusCode(200);
    }
}
