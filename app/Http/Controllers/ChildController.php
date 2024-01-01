<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChildController extends Controller
{
    public function showParents(User $child)
    {
        // Display a list of parents for a given child
        $parents = $child->parents;
        return response()->json(['child' => $child, 'parents' => $parents]);
    }

    public function addParent(Request $request, User $child)
    {
        $request->validate([
            'parent_id' => 'required|exists:users,id',
        ]);

        $parent = User::find($request->parent_id);
        $parent->children()->attach($child);

        return response()->json(['message' => 'Parent added successfully']);
    }

    public function updateParent(Request $request, User $child, User $parent)
    {
        // Update parent information or relationship attributes if needed
        // ...

        return response()->json(['message' => 'Parent updated successfully']);
    }

    public function deleteParent(User $child, User $parent)
    {
        $child->parents()->detach($parent);

        return response()->json(['message' => 'Parent removed successfully']);
    }
}
