<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;

class ItemController extends Controller
{
    public function store(Request $request, Checklist $checklist)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $item = $checklist->items()->create([
            'name' => $request->name,
            'is_completed' => false,
        ]);

        return response()->json($item, 201);
    }

    public function show(Item $item)
    {
        return response()->json($item);
    }

    public function update(Request $request, Item $item)
    {
        $item->update($request->all());
        return response()->json($item);
    }

    public function updateStatus(Request $request, Item $item)
    {
        $item->update(['is_completed' => $request->is_completed]);
        return response()->json($item);
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    }
}