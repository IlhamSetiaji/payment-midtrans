<?php

namespace App\Services\Item;

use LaravelEasyRepository\Service;
use App\Repositories\Item\ItemRepository;

class ItemServiceImplement extends Service implements ItemService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(ItemRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)

    public function addToCart(array $payload)
    {
        $item = $this->mainRepository->find($payload['item_id']);
        if (!$item) {
            throw new \Exception('Item not found');
        }
        if ($item->stock < $payload['quantity']) {
            throw new \Exception('Item quantity is not enough');
        }
        $item->cart()->attach(auth()->user()->id, ['quantity' => $payload['quantity']]);
        $item->stock -= $payload['quantity'];
        $item->save();
        return $item;
    }

    public function updateCart(array $payload)
    {
        // $item = $this->mainRepository->find($payload['item_id']);
        $item = auth()->user()->cart()->where('item_id', $payload['item_id'])->first();
        // return $item;
        if (!$item) {
            throw new \Exception('Item not found');
        }
        if ($item->stock < $payload['quantity']) {
            throw new \Exception('Item quantity is not enough');
        }
        if ($item->pivot->quantity > $payload['quantity']) {
            $item->stock += $item->pivot->quantity - $payload['quantity'];
        } else {
            $item->stock -= $payload['quantity'] - $item->pivot->quantity;
        }
        $item->cart()->updateExistingPivot(auth()->user()->id, ['quantity' => $payload['quantity']]);
        // $item->stock -= $payload['quantity'];
        $item->save();
        return $item;
    }

    public function removeFromCart(array $payload)
    {
        $item = auth()->user()->cart()->where('item_id', $payload['item_id'])->first();
        if (!$item) {
            throw new \Exception('Item not found');
        }
        $item->stock += $item->pivot->quantity;
        $item->cart()->detach(auth()->user()->id);
        $item->save();
        return $item;
    }
}
