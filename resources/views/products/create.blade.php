@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Add New Product</h2>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">SKU</label>
            <input type="text" name="sku" class="form-control" value="{{ old('sku') }}" required>
            @error('sku') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" required>
            @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="text" name="price" class="form-control" value="{{ old('price') }}" required>
            @error('price') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Add Product</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
