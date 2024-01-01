<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParentController extends Controller
{
    public function showChildren(User $parent)
    {
        $children = $parent->children;
        return response()->json(['parent' => $parent, 'children' => $children]);
    }

    public function createChild(Request $request, User $parent)
    {
        $request->validate([
            'child_id' => 'required|exists:users,id',
        ]);

        $child = User::find($request->child_id);
        $parent->children()->attach($child);

        return response()->json(['message' => 'Child added successfully']);
    }

    public function updateChild(Request $request, User $parent, User $child)
    {
        // Update child information or relationship attributes if needed
        // ...

        return response()->json(['message' => 'Child updated successfully']);
    }

    public function deleteChild(User $parent, User $child)
    {
        $parent->children()->detach($child);

        return response()->json(['message' => 'Child removed successfully']);
    }
}
