<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        "question",
        "type",
        "form_id"
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class, "form_id");
    }

    public function values(): HasMany
    {
        return $this->hasMany(Value::class, "question_id");
    }
}
