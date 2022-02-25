<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Builder, Model};
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'is_active', 'show', 'password_confirmed', 'email', 'activated_at'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withTimestamps();
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class)->withPivot('value')->withTimestamps()->using(ItemProperty::class);
    }

}
