<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class UpdateDocumentController extends Controller
{
    // validate document
    public function updateDocument(Request $request)
    {
        // validate the request
        $request->validate([
            'transaction_id' => 'required',
            //    validate document type, only allow pdf
            'document' =>
            [
                'required',
                File::types('application/pdf'),
                // ->min(1024)
                // ->max(12 * 1024),
            ],
        ]);

        //check if validation fails
        if ($request->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $request->errors()
            ], 400);
        }
        // upload document
        // $request->file('document')->store('public/documents');

        // find order by transaction_id
        $order = Order::where('transaction_id', $request->transaction_id)->first();

        // update document
        $order->update([
            'shipping_instruction_document_url' => $request->shipping_instruction_document_url,
            'bill_of_lading_document_url' => $request->bill_of_lading_document_url,
            'cargo_manifest_document_url' => $request->cargo_manifest_document_url,
            'time_sheet_document_url' => $request->time_sheet_document_url,
            'draught_survey_document_url' => $request->draught_survey_document_url,
        ]);

        return response()->json([
            'message' => 'Document updated successfully',
            'data' => $order
        ]);
    }
}
