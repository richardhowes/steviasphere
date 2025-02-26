<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organisation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'country',
    ];

    /**
     * Get the farming blocks for the organisation.
     */
    public function farmingBlocks(): HasMany
    {
        return $this->hasMany(FarmingBlock::class);
    }

    /**
     * Get the factories for the organisation.
     */
    public function factories(): HasMany
    {
        return $this->hasMany(Factory::class);
    }
} 