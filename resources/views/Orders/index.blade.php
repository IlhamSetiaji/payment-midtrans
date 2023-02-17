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
        <h1>Items</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Number</th>
                    <th scope="col">Status</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Snap Token</th>
                    <th scope="col">Redirect URL</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $order->number }}</td>
                        <td>{{ $order->status }}</td>
                        <td>Rp. {{ number_format($order->total_price) }}</td>
                        <td>{{ $order->snap_token }}</td>
                        <td>{{ $order->redirect_url }}</td>
                        <td><a class="btn btn-primary" href="{{ $order->redirect_url }}" target="_blank">Pay</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
