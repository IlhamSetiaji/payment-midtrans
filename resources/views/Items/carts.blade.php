<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bootstrap 5 Login form Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/items') }}">Items</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/carts') }}">Carts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/orders') }}">Orders</a>
                    </li>
                </ul>
                <div class="d-flex">
                    {{-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> --}}
                    <a class="btn btn-outline-success" href="{{ url('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        @if (session('success'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        @endif
        <h1>Carts</h1>
        <form action="{{ url('orders/create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="price">Total Price</label>
                <input type="text" class="form-control" id="price" value="Rp. {{ number_format($price) }}"
                    disabled>
                <input type="hidden" name="total_price" value="{{ $price }}">
            </div>
            <button type="submit" class="btn btn-primary">Checkout</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Weight</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <form action="{{ url('/carts/update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->stock }}</td>
                            <td>{{ $item->weight }}</td>
                            <td>Rp. {{ number_format($item->price) }}</td>
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <td><input type="number" name="quantity" value="{{ $item->pivot->quantity }}"
                                    min="1" max="{{ $item->stock }}"></td>
                            <td><button class="btn btn-primary" type="submit">Update Cart</button></td>
                            <td><button class="btn btn-danger" type="submit"
                                    formaction="{{ url('carts/remove') }}">Remove Item</button></td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
