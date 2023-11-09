<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'state',
        'city',
        'address',
        'complementary',
        'property_id',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(
            related: Property::class,
            foreignKey: 'property_id'
        );
    }
}
