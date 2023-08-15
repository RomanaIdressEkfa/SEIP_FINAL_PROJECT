
@extends('backend.master')
@section('page_content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Table with Action Buttons</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Table with Action Buttons</h1>
        {{-- @dd($tables) --}}
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i=1
                @endphp
                @foreach ($products as $product)
                <tr>
                    <td>{{$i++}}</td>
                    <td>
                        <img src="{{asset('images/products/'.$product->image)}}" alt="">
                    </td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td>
                        <a href="{{route('edit',$product->id)}}" class="btn btn-primary">Edit</a>
                        <a href="{{route('delete',$product->id)}}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach


                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>

    <a href="{{route('create')}}" class="btn btn-success mt-5 mb-5">Please Create Meeee!!!!!</a>
</body>
</html>


@endsection
