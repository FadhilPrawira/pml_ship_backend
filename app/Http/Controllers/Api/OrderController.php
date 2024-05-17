<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddShipperConsigneeRequest;
use App\Http\Requests\OrderPortRequest;
use App\Http\Requests\QuotationRequest;
use App\Http\Requests\SummaryOrderRequest;
use App\Http\Resources\AddShipperConsigneeResource;
use App\Http\Resources\OrderPortResource;
use App\Http\Resources\SummaryOrderResource;

use App\Models\Order;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function orderPort(OrderPortRequest $request)
    {
        $data = $request->validated();
        $data['transaction_id'] = 'TRX' . time();
        $data['status'] = 'order_pending';
        $data['user_id'] = $request->user()->id;
        $orderPortData = Order::create($data);

        return (new OrderPortResource($orderPortData))->response()->setStatusCode(201);
    }

    public function addShipperConsignee(AddShipperConsigneeRequest $request)
    {
        //        Validate if user is authenticated
        $user = Auth::user();

        //        Validate data
        $data = $request->validated();

        //        Find order by transaction_id and user_id
        $order = Order::where('transaction_id', $data['transaction_id'])
            ->where('user_id', $user->id)
            ->first();


        if (isset($data['shipper_name'])) {
            $order->shipper_name = $data['shipper_name'];
        }
        if (isset($data['shipper_address'])) {
            $order->shipper_address = $data['shipper_address'];
        }
        if (isset($data['consignee_name'])) {
            $order->consignee_name = $data['consignee_name'];
        }
        if (isset($data['consignee_address'])) {
            $order->consignee_address = $data['consignee_address'];
        }

        $order->save();
        return (new AddShipperConsigneeResource($order))->response()->setStatusCode(201);
    }


    public function summaryOrder(SummaryOrderRequest $request)
    {
        // Validate if user is authenticated
        $user = Auth::user();

        // Validate data
        $data = $request->validated();

        // Retrieve the order summary
        $orderSummary = Order::with(['portOfLoading', 'portOfDischarge'])
            ->where('transaction_id', $data['transaction_id'])
            ->first();

        // If not found, throw 404 error
        if (!$orderSummary) {
            throw new HttpResponseException(
                response([
                    "errors" => [
                        "message" => [
                            "Transaction not found."
                        ]
                    ]
                ], 404)
            );
        }

        // Return the response
        return (new SummaryOrderResource($orderSummary))->response()->setStatusCode(200);
    }

    public function quotation(QuotationRequest $request)
    {
        // Validate if user is authenticated
        $user = Auth::user();

        // Validate data
        $data = $request->validated();


//        Do something here

//        Load all kapal, rute, estimasi hari, estimasi biaya
//        "transaction_id" => $this->transaction_id,
//                "port_of_loading_id" => $this->portOfLoading['name'],
//                "port_of_discharge_id" => $this->portOfDischarge['name'],
//                "date_of_loading" => $this->date_of_loading,

//                Kapal A dipilih
//
//Rute: Lokasi terakhir kapal A- Pelabuhan loading - Pelabuhan discharge
//Estimasi hari (estimasi waktu dari lokasi terakhir menuju pelabuhan loading + estimasi waktu perjalanan dengan barang[sudah termasuk lamanya bongkar muat] = 10 hari)
//Estimasi biaya (biaya perjalanan dari lokasi tearkhir + biaya perjalanan)
//

        // If not found, throw 404 error
        if (!$orderSummary) {
            throw new HttpResponseException(
                response([
                    "errors" => [
                        "message" => [
                            "Transaction not found."
                        ]
                    ]
                ], 404)
            );
        }
// Return the response
        return (new SummaryOrderResource($orderSummary))->response()->setStatusCode(200);
    }
}
