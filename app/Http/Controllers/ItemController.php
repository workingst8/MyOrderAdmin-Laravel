<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{

    //CRUD
    public function createItem(Request $request)
    {
        $item = new Item;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imagePath = $file->store('images/product', 'public');
            $item->image = $imagePath;
        }

        $item->product = $request->product;
        $item->price = $request->price;
        $item->save();

        return back()->with("item_created", '등록되었습니다.');
    }
    
    public function getAllItems()
    {
        $items = Item::paginate(5);
        return view('items', compact('items'));
    }

    public function getAllItemsApi()
    {
        $items = Item::all();
        return response()->json($items);
    }

    public function updateItem(Request $request, $id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['message' => '게시물을 찾을 수 없습니다.'], 404);
        }

        $item->product = $request->product;
        $item->price = $request->price;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imagePath = $file->store('images/product', 'public');
            $item->image = $imagePath;
        }

        $item->save();

        return response()->json(['message' => '수정되었습니다.']);
    }

    public function deleteItem($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['message' => '게시물을 찾을 수 없습니다.'], 404);
        }

        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return response()->json(['message' => '삭제되었습니다.']);
    }

}
