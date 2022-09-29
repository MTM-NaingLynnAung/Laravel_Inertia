<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render('Product/Edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image' => 'nullable'
        ]);
        $product = Product::find($request->id);
        info($product);
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|mimes:jpg,png,jpeg'
            ]);
            $filePath = "storage/".$product->image;
            info($filePath);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
