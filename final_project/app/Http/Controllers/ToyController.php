<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toy;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ToyController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $category_id = $request->input('category_id');

        $toys = Toy::query();

        if ($query) {
            $toys->where('name', 'LIKE', "%{$query}%");
        }

        if ($category_id) {
            $toys->where('category_id', $category_id);
        }

        $toys = $toys->get();
        $categories = Category::all();

        return view('toys.index', compact('toys', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('toys.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required'
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Toy::create([
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'image' => $imagePath,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('toys.index')->with('success', 'Toy created successfully.');
    }

    public function show($id)
    {
        $toy = Toy::findOrFail($id); // Menggunakan findOrFail untuk menangani kasus tidak ditemukan
        return view('toys.show', compact('toy'));
    }

    public function edit($id)
    {
        $toy = Toy::findOrFail($id);
        $categories = Category::all();
        return view('toys.edit', compact('toy', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'stock' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required'
        ]);

        $toy = Toy::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $toy->image);
            $imagePath = $request->file('image')->store('images', 'public');
            $toy->image = $imagePath;
        }

        $toy->update([
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('toys.index')->with('success', 'Toy updated successfully.');
    }

    public function destroy($id)
    {
        $toy = Toy::findOrFail($id);
        Storage::delete('public/' . $toy->image);
        $toy->delete();

        return redirect()->route('toys.index')->with('success', 'Toy deleted successfully.');
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }

    public function filter(Request $request)
    {
        return $this->index($request);
    }

}
