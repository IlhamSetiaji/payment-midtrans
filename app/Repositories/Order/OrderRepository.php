<?php

namespace App\Repositories\Order;

use LaravelEasyRepository\Repository;

interface OrderRepository extends Repository
{

    // Write something awesome :)

    public function findBy($key, $value);
}
