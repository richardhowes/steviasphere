<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Harvest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'farming_block_id',
        'harvest_date',
        'quantity_harvested',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'harvest_date' => 'date',
        'quantity_harvested' => 'decimal:2',
    ];

    /**
     * Get the farming block that owns the harvest.
     */
    public function farmingBlock(): BelongsTo
    {
        return $this->belongsTo(FarmingBlock::class);
    }

    /**
     * Get the samples for the harvest.
     */
    public function samples(): HasMany
    {
        return $this->hasMany(Sample::class);
    }

    /**
     * Get the stock levels for the harvest.
     */
    public function stockLevels(): HasMany
    {
        return $this->hasMany(StockLevel::class);
    }
} 