<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class prodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = $request->input('search');
    $product = Products::when($query, function ($q) use ($query) {
        $q->where('name', 'LIKE', '%' . $query . '%');
        
        
    })
    ->orderBy('name', 'asc')
    ->paginate(12);
        

    return view('product.index', compact('product'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("product.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0.01',
            'quantity' => 'required|integer|min:1',
            'image' => 'required|mimes:png,jpeg,webp,jpg,gif|max:2048'
        ]);
        
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storeAs(
                'products', 
                time().'.'.$request->file('image')->getClientOriginalExtension(),
                'public'
            );
        }
    
        Products::create([
            'name' => $validate['name'],
            'description' => $validate['description'],
            'price' => $validate['price'],
            'quantity' => $validate['quantity'],
            'image' => $imagePath
        ]);
    
        return redirect()->route('product.index')->with('success', 'Product Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        $product = Products::findOrFail($id);
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Products::findOrFail($id); 
        return view('product.edit', compact('product')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0.01',
            'quantity' => 'required|integer|min:1',
            'image' => 'nullable|mimes:png,jpeg,webp,jpg,gif|max:2048' 
        ]);
        
        $product = Products::findOrFail($id);
    
        if ($request->hasFile('image')) {
            if ($product->image && \Storage::disk('public')->exists($product->image)) {
                \Storage::disk('public')->delete($product->image);
            }
    
            
            $imagePath = $request->file('image')->storeAs(
                'products',
                time().'.'.$request->file('image')->getClientOriginalExtension(),
                'public'
            );
            $validate['image'] = $imagePath; 
        } else {
            $validate['image'] = $product->image;
        }
    
        $product->update($validate);
        return redirect()->route('product.index')->with('success', 'Product Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Products::findOrFail($id);

    if ($product->image && \Storage::disk('public')->exists($product->image)) {
        \Storage::disk('public')->delete($product->image);
    }

   
    $product->delete();
    return redirect()->route('product.index')->with('success', 'Product Deleted successfully!');
    }
}
