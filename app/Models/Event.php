<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'additional_info',
        'city',
        'location',
        'event_date',
        'event_time',
        'starting_price',
        'image',
        'status',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}