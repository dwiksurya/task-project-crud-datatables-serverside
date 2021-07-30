@extends('layouts.master')

@section('titile', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body d-flex align-items-center gap-4">
            <i class="fa fa-store fa-5x"></i>
            <div class="content ml-4">
                <h5 class="card-title">Merchants</h5>
                <p class="card-text">Total Merchants: {{ App\Models\Merchant::count() }}</p>
                <a href="{{ route('merchant.index') }}" class="btn btn-primary btn-sm">Manage Merchants</a>
            </div>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
          <div class="card-body d-flex align-items-center gap-4">
              <i class="fa fa-box fa-5x pr-4"></i>
              <div class="content ml-4">
                  <h5 class="card-title">Product</h5>
                  <p class="card-text">Total Product: {{ App\Models\Product::count() }}</p>
                  <a href="{{ route('product.index') }}" class="btn btn-primary btn-sm">Manage Products</a>
              </div>
          </div>
        </div>
      </div>
  </div>
@endsection