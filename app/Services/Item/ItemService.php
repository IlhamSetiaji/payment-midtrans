<?php

namespace App\Services\Item;

use LaravelEasyRepository\BaseService;

interface ItemService extends BaseService
{

    // Write something awesome :)

    public function addToCart(array $payload);
    public function updateCart(array $payload);
    public function removeFromCart(array $payload);
}
