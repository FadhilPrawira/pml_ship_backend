<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Port;

class PortController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all ports
        $ports = Port::all();

        // Check if there are ports
        if ($ports->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ports data is empty',
                'data' => []
            ])->setStatusCode(204);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Get ports list success',
            'data' => $ports
        ])->setStatusCode(200);
    }
}
