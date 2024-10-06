<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class AdminItemController extends Controller
{
    public function unapprovedItems()
    {
        $items = Item::where('status', 'pending')->get();
        if (count($items) > 0) {
            return response()->json([
                'success' => true,
                'items' => $items
            ]);
        }
    }
}
