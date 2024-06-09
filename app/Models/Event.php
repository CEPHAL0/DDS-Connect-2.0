<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "capacity",
        "status",
        "event_image_url",
        "price"
    ];


    public function eventBookings(): HasMany
    {
        return $this->hasMany(EventBooking::class, "event_id");
    }
}
