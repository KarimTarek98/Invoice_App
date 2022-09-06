<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $sections = Section::get();
        $products = Product::get();
        return view('products.index', compact('sections', 'products'));
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|max:255|unique:products',
            'description' => 'required|max:255',
            'section_id' => 'required'
        ], [
            'product_name.required' => 'Product name can\'t be empty',
            'product_name.unique' => 'Section name already exsist',
            'description.required' => 'Please write description for this section'
        ]);

        Product::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'section_id' => $request->section_id
        ]);

        session()->flash('Add', 'Product Added Successfully');
        return redirect('/products');
    }


    public function show(Product $product)
    {

    }


    public function edit(Product $product)
    {

    }


    public function update(Request $request)
    {
        $id = Section::where('section_name', $request->section_name)
        ->first()->id;

        $product = Product::findorFail($request->product_id);

        $product->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'section_id' => $id
        ]);

        session()->flash('Edit', 'Product Updated Successfully !');
        return redirect('/products');

    }


    public function destroy(Request $request)
    {
        $id = $request->id;

        Product::findorFail($id)->delete();

        session()->flash('Delete', 'Product Deleted !');

        return redirect()->back();
    }
}
