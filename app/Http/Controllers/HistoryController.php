<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function store(Request $request)
    {
        History::create([
            'light' => $request->light,
            'temperature' => $request->temperature,
            'led_state' => $request->led_state,
        ]);
    
        return response()->json(['message' => 'Saved']);
    }
    
    public function index()
    {
        return response()->json(History::latest()->take(10)->get());
    }
    

}

