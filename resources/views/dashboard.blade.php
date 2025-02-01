


@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard & Reports</h2>

    <!-- Total Products -->
    <div class="card mb-4 p-3">
        <h4>Total Products</h4>
        <p>{{ $totalProducts }} products available</p>
    </div>

    <!-- Low Stock Alerts -->
    <div class="card mb-4 p-3">
        <h4>Low Stock Alerts</h4>
        <ul>
            @forelse ($lowStockProducts as $product)
                <li>{{ $product->name }} - Stock: {{ $product->quantity }}</li>
            @empty
                <li>No low-stock products.</li>
            @endforelse
        </ul>
    </div>

    <!-- Stock Movement Report -->
    <div class="card p-4">
        <h4>Stock Movement Report</h4>
        
        <!-- Filter Form -->
        <form action="{{ route('dashboard.index') }}" method="GET" class="mb-4">
            @csrf
            <div class="d-flex gap-3">
                <div class="mb-3">
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

                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ request()->start_date }}">
                </div>

                <!-- <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ request()->end_date }}">
                </div> -->

                <button type="submit" class="btn btn-primary align-self-end">Filter</button>
            </div>
        </form>

        <table class="table">
            <thead>
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
@endsection


