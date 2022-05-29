<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessType;

class HomeController extends Controller
{
    public function index()
    {
        $categories = BusinessType::all();

        return response()->json([
            'categories' => $categories
        ]);
    }

    public function categories()
    {
        $categories = BusinessType::all();

        return response()->json([
            'categories' => $categories
        ]);
    }
}
