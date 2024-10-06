<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $item = Item::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post inserted successfully!',
            'items' => $item,
        ], 201);
    }

    public function index(Request $request)
    {
        $items = Item::where('user_id', Auth::id())->get();
        return response()->json($items);
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        if ($item->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'msg' => 'Unauthorize user!']);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
        ]);

        $item->update($validated);
        return response()->json([
            'success' => true,
            'message' => 'Post Updated successfully!',
            'items' => $item,
        ]);
    }

    public function delete($id)
    {
        $item = Item::findOrFail($id);

        if ($item->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'msg' => 'Unauthorize user!']);
        }

        $item->delete();
        return response()->json([
            'success' => true,
            'message' => 'Post Deleted successfully!',
        ]);
    }
}
