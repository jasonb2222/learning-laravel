<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all()
    {
        $products = Product::paginate(10);
        return view('product', [
            'products' => $products,

        ]);
    }

    public function find(int $id)
    {
        $product = Product::findorFail($id);
        return view('singleProduct', [
            'product' => $product,
        ]);
    }

    public function addForm()
    {
        return view('addProduct');
    }

    public function create(Request $request)
    {
        // TODO: Validate the data
        $request->validate([
            'name' => 'required|string|min:2|max:70',
            'description' => 'required|string|min:50',
            'price' => 'required|string|max:255',
            'stock' => 'required|string|min:1',

        ]);
        $newProduct = new Product();

        // Transfer the data from the request (form) into the blank product
        $newProduct->name = $request->name;
        $newProduct->description = $request->description;
        $newProduct->price = $request->price;
        $newProduct->stock = $request->stock;
        // Save the data to the posts table
        $newProduct->save();

        // Send some kind of response
        return redirect('/products');
    }
}
