<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class, "response_user_id");
    }
}
