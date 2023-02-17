<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function cart()
    {
        return $this->belongsToMany(User::class, 'carts', 'item_id', 'user_id')->withPivot('quantity')->withTimestamps();
    }
}
