<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use Response;


class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('merchant.index');
    }

    public function data()
    {
        $merchants = Merchant::all();

        return datatables::of($merchants)
        ->addIndexColumn()
        ->addColumn('total_products', function($merchants) {
            return $merchants->products->count();
        })
        ->addColumn('action', function($merchants) {
            return '
            <button type="button" onclick="editForm(`'.route('merchant.update', $merchants->id).'`)" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
            <button type="button" onclick="deleteData(`'.route('merchant.destroy', $merchants->id).'`)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
            ';
        })
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
        Merchant::create([
            'merchant_name' => $request->merchant_name,
            'country_code' => Str::upper($request->country_code),
        ]);

        return Response::json(['success'=> 'Merchant successfully added!'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function show(Merchant $merchant)
    {
        return response()->json($merchant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $merchant)
    {
        $merchant->update([
            'merchant_name' => $request->merchant_name,
            'country_code' => $request->country_code,
        ]);

        return Response::json(['success'=> 'Merchant successfully updated!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchant $merchant)
    {
        $merchant->delete();
        return Response::json(['success'=> 'Merchant successfully deleted!'], 200);
    }
}
