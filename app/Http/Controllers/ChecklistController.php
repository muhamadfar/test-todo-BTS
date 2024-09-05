<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ChecklistController extends Controller
{
    public function index()
    {
        $checklists = auth()->user()->checklists()->with('items')->get();
        return response()->json($checklists);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:checklists,name,NULL,id,user_id,' . auth()->id(),
        ]);

        $checklist = auth()->user()->checklists()->create($request->all());

        return response()->json($checklist, 201);
    }

    public function show(Checklist $checklist)
    {
        if ($checklist->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($checklist->load('items'));
    }

    public function destroy(Checklist $checklist)
    {
        if ($checklist->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $checklist->delete();
        return response()->json(['message' => 'Checklist deleted successfully']);
    }
}
