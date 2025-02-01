@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="display-4 fw-bold">Stock Management</h2>
        </div>
    </div>

    <div class="row">
    <div class="col-12 col-md-6 col-lg-4 mb-4">
        <div class="card shadow border-0 rounded-3 bg-primary text-white h-100">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-box-seam fs-3 me-4"></i>
                <div>
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text">{{ $totalProducts }} products available</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4 mb-4">
        <div class="card shadow border-0 rounded-3 bg-danger text-white h-100">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-exclamation-triangle fs-3 me-4"></i>
                <div>
                    <h5 class="card-title">Low Stock Alerts</h5>
                    <ul class="m-0">
                        @forelse ($lowStockProducts as $product)
                            <li>{{ $product->name }} - Stock: {{ $product->quantity }}</li>
                        @empty
                            <li>No low-stock products.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>


    <div class="card shadow-sm border-0 rounded-3 p-4 mb-4 bg-light">
        <h4>Stock Movement Report</h4>

        <form action="{{ route('dashboard.index') }}" method="POST" class="mb-4">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="product" class="form-label">Product</label>
                    <select name="product_id" id="product" class="form-select">
                        <option value="">Select a product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" 
                                @if(request()->product_id == $product->id) selected @endif>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ request()->start_date }}">
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Remarks</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stockMovements as $movement)
                        <tr>
                            <td>{{ $movement->product->name }}</td>
                            <td>{{ $movement->type }}</td>
                            <td>{{ $movement->quantity }}</td>
                            <td>{{ $movement->remarks }}</td>
                            <td>{{ $movement->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
