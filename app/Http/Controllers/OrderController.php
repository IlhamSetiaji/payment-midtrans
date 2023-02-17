<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\CreateOrderRequest;

class OrderController extends Controller
{

    /**
     * @var \App\Services\Order\OrderService
     */
    private $orderService;

    public function __construct(\App\Services\Order\OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->get();
        return view('Orders.index', compact('orders'));
    }

    public function createOrder(CreateOrderRequest $request)
    {
        $payload = $request->validated();
        $snapMidtrans = $this->orderService->createOrder($payload);
        return redirect($snapMidtrans->redirect_url);
    }

    public function finishedTransaction(Request $request)
    {
        $this->orderService->finishedTransaction($request->order_id);
        return redirect()->route('home')->with('success', 'Transaction successfully');
    }
}
