<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Merchant;
use Illuminate\Http\Request;
use DataTables;
use Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index', ['merchant' => Merchant::all()]);
    }

    public function data()
    {
        $products = Product::all();
       
        return datatables::of($products)
        ->addIndexColumn()
        ->addColumn('select_all', function ($products) {
            return '
                <input type="checkbox" name="product_id[]" value="'. $products->id .'">
            ';
        })
        ->addColumn('price', function($products) {
            return  number_format($products->price, 0, ',', '.') ;
        })
        ->addColumn('status', function($products) {
            return $products->status === 1 ? 'Active' : 'Inactive' ;
        })
        ->addColumn('merchant', function($products) {
            return $products->merchant->merchant_name;
        })
        ->addColumn('action', function($products) {
            return '
            <button type="button" onclick="editForm(`'.route('product.update', $products->id).'`)" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
            <button type="button" onclick="deleteData(`'.route('product.destroy', $products->id).'`)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
            ';
        })
        ->rawColumns(['select_all', 'action'])
        ->make(true);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'merchant_id' => 'required',
            'price' => 'required|integer',
        ]);

        Product::create([
            'name' => $request->name,
            'merchant_id' => $request->merchant_id,
            'price' => $request->price,
            'status' => $request->status ?? 0,

        ]);

        return Response::json(['success'=> 'Product successfully added!'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'merchant_id' => 'required',
            'price' => 'required|integer',
        ]);

        $product->update([
            'name' => $request->name,
            'merchant_id' => $request->merchant_id,
            'price' => $request->price,
            'status' => $request->status ?? 0,
        ]);

        return Response::json(['success' => 'Product successfully updated!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return Response::json(['success' => 'Product successfully deleted!'], 200);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->product_id as $id) {
            $product = Product::find($id);
            $product->delete();
        }

        return Response::json(['success' => 'Selected product successfully deleted!'], 200);
    }

    public function activeSelected(Request $request)
    {
        foreach ($request->product_id as $id) {
            $product = Product::find($id);
            $product->update(['status' => true]);
        }

        return Response::json(['success' => 'Selected product status successfully updated!'], 200);
    }
}
