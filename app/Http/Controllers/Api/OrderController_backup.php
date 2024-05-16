<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController_backup extends Controller
{
    // function for order
    public function order(Request $request)
    {
        // validate the request
        $request->validate([
            'shipper_name' => 'required',
            'shipper_address' => 'required',
            'consignee_name' => 'required',
            'consignee_address' => 'required',
            'port_of_loading_id' => 'required',
            'port_of_discharge_id' => 'required',
            'date_of_loading' => 'required',
            'date_of_discharge' => 'required',
            'cargo_description' => 'required',
            'cargo_weight' => 'required',
        ]);


        // create order
        $order = Order::create([
            'transaction_id' => 'TRX' . time(),
            'user_id' => $request->user()->id,
            'shipper_name' => $request->shipper_name,
            'shipper_address' => $request->shipper_address,
            'consignee_name' => $request->consignee_name,
            'consignee_address' => $request->consignee_address,
            'port_of_loading_id' => $request->port_of_loading_id,
            'port_of_discharge_id' => $request->port_of_discharge_id,
            'date_of_loading' => $request->date_of_loading,
            'date_of_discharge' => $request->date_of_discharge,
            'status' => 'order_still_verified_by_admin', // default status is 'order_still_verified_by_admin
            'cargo_description' => $request->cargo_description,
            'cargo_weight' => $request->cargo_weight,
            'total_cost' => $request->total_cost,
        ]);

        // TODO: Pisahkan column shipping_instruction_document_url, bill_of_lading_document_url, cargo_manifest_document_url, time_sheet_document_url, draught_survey_document_url ke tabel sendiri

        // TODO: Pisahkan shipper dan consignee ke tabel sendiri supaya bisa di reuse
        // TODO: Create Migration tabel shipper dan tabel consignee, hubungkan ke tabel order

        // TODO: Uncomment code di bawah ini jika sudah membuat tabel shipper dan consignee
        // ShipperData::create([
        //     'shipper_name' => $request->shipper_name,
        //     'shipper_address' => $request->shipper_address,
        // ]);

        // ConsigneeData::create([
        //     'consignee_name' => $request->consignee_name,
        //     'consignee_address' => $request->consignee_address,

        // TODO: Tambahkan notify party (nullable) (Migration dan tabel)


        // return response
        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order
        ]);
    }
}
