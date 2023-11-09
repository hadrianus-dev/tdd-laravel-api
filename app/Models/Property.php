<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'body',
        'initial_price',
        'designation',
        'published',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Category::class
        );
    }

    public function places(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Place::class
        );
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Feature::class
        );
    }

    public function address(): HasOne
    {
        return $this->hasOne(
            related: Address::class,
            foreignKey: 'property_id',
            localKey: 'id',
        );
    }
}
