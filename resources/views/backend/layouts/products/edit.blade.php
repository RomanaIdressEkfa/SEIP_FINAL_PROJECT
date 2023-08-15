
@extends('backend.master')
@section('page_content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Index Form</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Index Form</h1>

        <form action="{{route('update',$product->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Image</label>
                <img src="{{asset('images/products/'.$product->image)}}" alt="">
                <input type="file" class="form-control" id="image" name="image" value="{{$product->title}}" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Price</label>
              <input type="number" name="price" id="price" value="{{$product->price}}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>



@endsection
