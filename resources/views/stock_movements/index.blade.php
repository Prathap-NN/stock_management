@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Stocks</h2>

    <!-- <form method="GET" action="{{ route('stock_movements.index') }}">
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="product_id">Select Product:</label>
                <select name="product_id" id="product_id" class="form-control">
                    <option value="">All Products</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>

            <div class="col-md-4">
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
        </div>

        <div class="d-flex justify-content-end mb-4">
    <button type="submit" class="btn btn-primary">Filter</button>
</div>

    </form> -->

    <a href="{{ route('stock_movements.create') }}" class="btn btn-primary mb-3">Add Stock</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Remarks</th>
                <th class="mx-auto p-2">Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movements as $movement)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $movement->product->name }}</td>
                <td>
                    <span class="badge {{ $movement->type == 'IN' ? 'bg-success' : 'bg-danger' }}">
                        {{ $movement->type }}
                    </span>
                </td>
                <td>{{ $movement->quantity }}</td>
                <td>{{ $movement->remarks }}</td>
                <td>{{ $movement->created_at->format('d M Y, H:i A') }}</td>
                <td>
                    <a href="{{ route('stock_movements.edit', $movement->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('stock_movements.destroy', $movement->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection