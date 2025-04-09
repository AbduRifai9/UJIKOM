<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Tiket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiTiketController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $tickets = Tiket::with('event')->latest()->get();
            return response()->json([
                'success' => true,
                'message' => 'List of all tickets',
                'data' => $tickets
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching tickets: ' . $e->getMessage()
            ], 500);
        }
    }

    // Add other methods as needed...
}
