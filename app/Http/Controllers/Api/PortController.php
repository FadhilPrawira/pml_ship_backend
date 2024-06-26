<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Port;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                'message' => 'Ports not found',
                'data' => []
            ])->setStatusCode(404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Get ports list success',
            'data' => $ports
        ])->setStatusCode(200);
    }
}
