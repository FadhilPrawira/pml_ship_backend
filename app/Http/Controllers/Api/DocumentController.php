<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDocumentRequest;
use App\Http\Resources\UpdateDocumentResource;
use App\Models\Document;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Get the authenticated user
        // $user = Auth::user();


        // Validate data
        $request->validate([
            'transaction_id' => 'required|string',
            'document_type' => 'required|string|in:shipping_instruction,bill_of_lading,cargo_manifest,time_sheet,draught_survey',
            'document_file' => ['required', File::types(['pdf'])],
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
            ])->setStatusCode(404);
        }

        // Check if the document type already exists
        $document = Document::where('transaction_id', $data['transaction_id'])
            ->where('document_type', $data['document_type'])
            ->first();

        // If document type already exists, return error
        if ($document) {
            return response()->json([
                'status' => 'error',
                'message' => 'Document ' . $data['document_type'] . ' already exists',
            ])->setStatusCode(400);
        }


        // Store the file in variable
        $document_file = $request->file('document_file');

        // Set file name
        // $cleaned_document_name = str_replace(" ", "_", $data['company_name']);
        $document_filename = $data['transaction_id'] . '-' . $data['document_type'] . '.' . $document_file->extension();


        // Store the new file
        $document_file->storeAs('public/documents', $document_filename);
        // Access file
        // http://10.104.220.16:8000/storage/documents/TRX1717142358-shipping_instruction.pdf

        // Create a new Document
        $document = new Document();
        $document->transaction_id = $data['transaction_id'];
        $document->document_name = $document_filename;
        $document->document_type = $data['document_type'];

        $document->save();


        return response()->json([
            'status' => 'success',
            'message' => 'Document uploaded successfully',
            'data' => $document,
        ])->setStatusCode(200);

        // return (new UpdateDocumentResource($order))->response()->setStatusCode(200);
    }

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
        $documents = Document::where('transaction_id', $transactionId)->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Documents found',
            'data' => $documents,
        ])->setStatusCode(200);
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
