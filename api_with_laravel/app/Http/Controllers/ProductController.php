<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralJsonException;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')
            ->where('deleted_at', '=', null)
            ->get();
        return response($products);
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
            'category' => 'required',
            'status' => 'required',
            'quantity' => 'required',
        ]);
        return Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'status' => $request->status,
            'quantity' => $request->quantity,
            'created_at' => date('Y-m-d h:i:s'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Product::where('id', $id)->exists()) {
            $product = Product::find($id);
            $product->update($request->all());
            $product->update([
                'update_at' => date('Y-m-d h:i:s'),
            ]);
            return response($product);
        } else {
            return throw new GeneralJsonException('Product not found', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Product::where('id', $id)->exists()) {
            $product = Product::find($id);
            $product->update([
                'deleted_at' => date('Y-m-d h:i:s'),
            ]);
            return response($product);
        } else {
            return throw new GeneralJsonException('Product not found', 404);
        }
    }
}