<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentDetailResource;
use App\Models\Document;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;


class DocumentController extends Controller
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
    // public function index(Request $request)
    // {
    //     $documents = Document::all();
    //     return $documents;
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     // Validate data
    //     $request->validate([
    //         'transaction_id' => 'required|string',
    //         'document_type' => 'required|string|in:shipping_instruction,SPAL,bill_of_lading,cargo_manifest,time_sheet,draught_survey',
    //         'document_file' => ['required', File::types(['pdf'])],
    //     ]);

    //     // Get all request data
    //     $data = $request->all();

    //     // Check if the order exists
    //     $order = Order::where('transaction_id', $data['transaction_id'])->first();

    //     // If order does not exist, return error
    //     if (!$order) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Transaction not found',
    //         ])->setStatusCode(404);
    //     }

    //     // Check if the document type already exists
    //     $document = Document::where('order_transaction_id', $data['transaction_id'])
    //         ->where('document_type', $data['document_type'])
    //         ->first();

    //     // If document type already exists, return error
    //     if ($document) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Document ' . $data['document_type'] . ' already exists',
    //         ])->setStatusCode(400);
    //     }

    //     // Store the file in variable
    //     $document_file = $request->file('document_file');

    //     // Set file name
    //     $document_filename = $data['transaction_id'] . '-' . $data['document_type'] . '.' . $document_file->extension();

    //     // Store the new file
    //     $document_file->storeAs('public/documents', $document_filename);
    //     // Access file
    //     // http://10.104.220.16:8000/storage/documents/TRX1717142358-shipping_instruction.pdf

    //     // Create a new Document
    //     $document = new Document();
    //     $document->transaction_id = $data['transaction_id'];
    //     $document->document_name = $document_filename;
    //     $document->document_type = $data['document_type'];

    //     $document->save();


    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Document uploaded successfully',
    //         'data' => new DocumentDetailResource($document),
    //     ])->setStatusCode(200);
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $transactionId)
    {
        // Check if the order exists
        $order = Order::where('transaction_id', $transactionId)->first();

        // If order does not exist, return error
        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Transaction not found',
            ])->setStatusCode(404);
        }

        // Get all documents from a specified transaction_id
        $documents = Document::where('order_transaction_id', $transactionId)->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Documents found',
            'data' => $documents,
        ])->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $transactionId, Request $request)
    {
        // Validate the request
        $request->validate([
            'document_type' => 'required|string|in:shipping_instruction,SPAL,bill_of_lading,cargo_manifest,time_sheet,draught_survey',
            'document_file' => ['required', File::types(['pdf'])],
        ]);

        // Get the document detail by transaction_id and document_type
        $document_detail = Document::where('order_transaction_id', $transactionId)
            ->where('document_type', $request->document_type)
            ->first();

        // Get all request data
        $data = $request->all();

        // Check if the form-data request has 'document_file' as key
        if ($request->hasFile('document_file')) {

            // Store the file in variable
            $new_document_file = $request->file('document_file');

            // Set file name
            $new_document_filename = $transactionId . '-' . $data['document_type'] . '.' . $new_document_file->extension();

            // Delete the old document_name file if it exists
            if ($document_detail->document_name) {
                // path to the company_akta file
                $old_document_path = 'public/documents/' . $document_detail->document_name;
                Storage::delete($old_document_path);
            }

            // Store the new file
            $new_document_file->storeAs('public/documents', $new_document_filename);
            // Access file
            // http://10.104.220.16:8000/storage/documents/TRX1717142358-shipping_instruction.pdf

        } else {
            // If the request does not have 'document_file' key
            // Set the document_name file to the old document_name file
            $new_document_file = $document_detail->document_name;
        }

        // Update the document_detail
        $document_detail->update([
            'document_name' => $new_document_filename,
            'document_type' => $data['document_type'],
            'uploaded_at' => Carbon::now(),
        ]);

        // if ($data['document_type'] == 'shipping_instruction') {
        //     $payment = Payment::create([
        //         'order_transaction_id' => $transactionId,
        //         'payment_type' => 'shipping_instruction',
        //         'amount' => 0,
        //         'status' => 'pending',
        //     ]);
        //     return $order;
        //     // $order->update([
        //     //     'shipping_instruction_uploaded_at' => Carbon::now(),
        //     // ]);
        // }

        return response()->json([
            'status' => 'success',
            'message' => 'Document updated.',
            'data' => new DocumentDetailResource($document_detail),
        ])->setStatusCode(200);
    }
}
