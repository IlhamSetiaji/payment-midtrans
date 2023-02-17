<?php

namespace App\Repositories\Order;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Order;

class OrderRepositoryImplement extends Eloquent implements OrderRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)

    public function findBy($key, $value)
    {
        return $this->model->where($key, $value)->first();
    }
}
