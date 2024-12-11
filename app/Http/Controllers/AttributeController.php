<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        // $attributes = Attribute::all();
        return view('pages.attributes.attribute-list');
    }

    public function addAttribute()
    {
        return view('pages.attributes.add-attribute');
    }

    public function storeAttribute(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'attribute_name' => 'required|string|max:255',
            'attribute_value' => 'required|string|max:255',
        ]);

        // Create a new attribute record
        $attribute = Attribute::create([
            'name' => $validated['attribute_name'],
            'value' => $validated['attribute_value'],
        ]);

        return redirect()->route('attribute.list')->with('success', 'Attribute added successfully!');
    }
}
