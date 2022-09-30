<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Product/Index', [
            'products' => Product::orderBy('id', 'desc')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Product/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg'
        ]);
        if($request->hasFile('image')){
            $fileName = time().'.'.$request->image->extension();
            Storage::putFileAs('public/images', $request->image, $fileName);
            $request->image = 'images/'.$fileName;
        }
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image
        ]);
        return redirect('product')->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        return Inertia::render('Product/Edit', compact('product'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image' => 'nullable'
        ]);
        $product = Product::find($request->id);
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|mimes:jpg,png,jpeg'
            ]);
            $filePath = "storage/".$product->image;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $fileName = time() . '.' . $request->image->extension();
            Storage::putFileAs('public/images', $request->image, $fileName);
            $request->image = "images/" . $fileName;
        }
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image
        ]);
        
        return redirect('product')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $filePath = "storage/".$product->image;
        if(file_exists($filePath)){
            unlink($filePath);
        }
        $product->delete();
        return redirect('product')->with('success', 'Product delete successfully');
    }
}
