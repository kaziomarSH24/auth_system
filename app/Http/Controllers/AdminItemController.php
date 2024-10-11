<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class AdminItemController extends Controller
{


    public function index()
    {
        $userCount = User::count();
        $itemCount = Item::count();
        $approvedPosts = Item::where('status', 'approved')->count();
        $unapprovedPosts = Item::where('status', 'pending')->count();
        return view('admin.dashboard', compact('userCount', 'itemCount', 'approvedPosts', 'unapprovedPosts'));
    }

    public function showUsers()
    {

        $users = User::all()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'verified' => $user->email_verified_at,
                'date' => $user->created_at->format('d-m-Y'),
            ];
        });

        return response()->json([
            'success' => true,
            'users' => $users
        ]);
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['success' => false, 'msg' => 'User not found!']);
        }

        $user->role = $request->role;
        $user->save();

        return response()->json(['success' => true, 'msg' => 'User role updated successfully!']);
    }


    public function getPosts(Request $request)
    {
        $status = $request->status;
        if ($status == '') {
            $items = Item::with('user')->get();
        } else {
            $items = Item::with('user')->where('status', $status)->get();
        }

        return response()->json([
            'success' => true,
            'items' => $items
        ]);
    }

    public function updateItemStatus(Request $request, $id)
    {

        $item = Item::find($id);
        if (!$item) {
            return response()->json(['success' => false, 'msg' => 'Post not found!']);
        }
        $item->status = $request->status;
        $item->save();

        return response()->json(['success' => true, 'msg' => 'Post status updated successfully!']);
    }

    //delete item
    public function deleteItem($id){
        $item = Item::find($id);

        if(!$item){
            return response()->json(['success'=>false, 'msg'=> 'Item not found!']);
        }
        $item->delete();
        return response()->json(['success' => true, 'msg' => 'Item deleted successfully!']);
    }

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
