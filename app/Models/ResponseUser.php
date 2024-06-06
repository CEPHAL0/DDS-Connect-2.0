<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResponseUser extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "form_id"
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class, "form_id");
    }
}