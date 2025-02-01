@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Stocks</h2>
   
   
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