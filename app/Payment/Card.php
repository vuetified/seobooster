<?php

namespace App\Payment;

use Illuminate\Database\Eloquent\Model;
use App\Gateway;
use App\Order;

class Card extends Model
{
    protected $table = "card_payments";

    public function gateway()
    {
        return $this->belongsTo(Gateway::class);
    }

    public function payments()
    {
        return $this->morphMany(Order::class, 'payment');
    }
}
