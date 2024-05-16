<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Port;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortController extends Controller
{
    public function get(Request $request)
    {
        $ports = Port::all();
        if ($ports->count() == 0) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => 'No ports found',
                ]
            ], 204));
        }

        return response()->json([
            'data' => $ports,
        ], 200);
    }
}
