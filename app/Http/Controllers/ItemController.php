<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * @var \App\Services\Item\ItemService
     */
    private $itemService;

    public function __construct(\App\Services\Item\ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function index()
    {
        $items = $this->itemService->all();
        return view('Items.index', compact('items'));
    }

    public function addToCart(AddToCartRequest $request)
    {
        $payload = $request->validated();
        $this->itemService->addToCart($payload);
        return redirect()->back()->with('success', 'Item added to cart successfully');
    }

    public function cart()
    {
        $items = auth()->user()->cart;
        $price = 0;
        foreach ($items as $item) {
            $price += $item->price * $item->pivot->quantity;
        }
        return view('Items.carts', compact('items', 'price'));
    }

    public function updateCart(AddToCartRequest $request)
    {
        $payload = $request->validated();
        $this->itemService->updateCart($payload);
        return redirect()->back()->with('success', 'Item updated successfully');
    }

    public function removeFromCart(AddToCartRequest $request)
    {
        $payload = $request->validated();
        $this->itemService->removeFromCart($payload);
        return redirect()->back()->with('success', 'Item removed from cart successfully');
    }
}
