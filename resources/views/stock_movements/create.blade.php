@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Add Stock</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('stock_movements.store') }}" method="POST" class="card p-4">
        @csrf
        <div class="mb-3">
            <label for="product" class="form-label">Product</label>
            <select name="product_id" id="product" class="form-select" required>
                <option value="" disabled selected>Select a product</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->quantity }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Movement Type</label>
            <div class="d-flex gap-3">
                <div class="form-check">
                    <input type="radio" name="type" id="type_in" value="IN" class="form-check-input" required>
                    <label for="type_in" class="form-check-label">Stock IN</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="type" id="type_out" value="OUT" class="form-check-input">
                    <label for="type_out" class="form-check-label">Stock OUT</label>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label for="remarks" class="form-label">Remarks (Optional)</label>
            <textarea name="remarks" id="remarks" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Movement</button>
        <a href="{{ route('stock_movements.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
