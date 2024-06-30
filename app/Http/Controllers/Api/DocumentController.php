<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDocumentRequest;
use App\Http\Resources\UpdateDocumentResource;
use App\Models\Document;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class DocumentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
    public function update(string $transactionId, Request $request)
    {
        // Validate the request
        $request->validate([
            'document_type' => 'required|string|in:shipping_instruction,bill_of_lading,cargo_manifest,time_sheet,draught_survey',
            'document_file' => ['required', File::types(['pdf'])],
        ]);

        // Get the document detail by transaction_id and document_type
        $document_detail = Document::where('transaction_id', $transactionId)
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


            // Delete the old company_akta file if it exists
            if ($document_detail->company_akta) {
                // path to the company_akta file
                $old_company_akta = 'public/documents/' . $document_detail->image;
                Storage::delete($old_company_akta);
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

        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Document updated.',
            'data' => $document_detail,
        ])->setStatusCode(200);
    }
}
