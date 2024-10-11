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
        $this->middleware('auth:api', ['except' => ['login', 'register', 'showApprovePost']]);
    }

    public function showApprovePost()
    {
        $approvedPosts = Item::with('user')
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->paginate(3);
            $approvedPosts->getCollection()->transform(function ($post) {
                if ($post->created_at) {
                    $post->create_time = $post->created_at->format('g:i A');
                    $post->formatted_time = $post->created_at->diffForHumans();
                } else {
                    $post->formatted_time = 'Unknown';
                }
                return $post;
            });
        return view('index', compact('approvedPosts'));
    }


    //create post
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
            'msg' => 'Post inserted successfully!',
            'items' => $item,
        ]);
    }


    public function index(Request $request)
    {
        $items = Item::where('user_id', Auth::id())->get();
        return response()->json($items);
    }

    public function singleItem($id)
    {
        $item = Item::where('id', $id)->first();
        if ($item) {
            return response()->json([
                'success' => true,
                'item' => $item
            ]);
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'No item found!'
            ]);
        }
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
            'msg' => 'Post Updated successfully!',
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
            'msg' => 'Post Deleted successfully!',
        ]);
    }
}
