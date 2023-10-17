<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('home', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'value' => 'required|numeric',
        ]);

        Category::create([
            'name' => $request->input('name'),
            'value' => $request->input('value'),
        ]);

        return redirect('/home');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'value' => 'required|numeric',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->input('name'),
            'value' => $request->input('value'),
        ]);

        return redirect('/home');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.edit', ['category' => $category]);
    }    
    

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('/home');
    }
}
