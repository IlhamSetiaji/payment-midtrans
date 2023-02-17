<?php

namespace App\Repositories\Item;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Item;

class ItemRepositoryImplement extends Eloquent implements ItemRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Item $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
