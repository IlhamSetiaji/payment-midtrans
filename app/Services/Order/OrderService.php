<?php

namespace App\Services\Order;

use LaravelEasyRepository\BaseService;

interface OrderService extends BaseService
{

    // Write something awesome :)

    public function createOrder(array $payload);
    public function finishedTransaction($number);
}
