<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockLevel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'factory_id',
        'harvest_id',
        'date_recorded',
        'stock_on_hand',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_recorded' => 'date',
        'stock_on_hand' => 'decimal:2',
    ];

    /**
     * Get the factory that owns the stock level.
     */
    public function factory(): BelongsTo
    {
        return $this->belongsTo(Factory::class);
    }

    /**
     * Get the harvest that owns the stock level.
     */
    public function harvest(): BelongsTo
    {
        return $this->belongsTo(Harvest::class);
    }
} 