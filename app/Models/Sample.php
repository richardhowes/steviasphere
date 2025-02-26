<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sample extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'harvest_id',
        'sample_code',
        'test_date',
        'pesticide_test_result',
        'tsg_test_result',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'test_date' => 'date',
        'pesticide_test_result' => 'decimal:2',
        'tsg_test_result' => 'decimal:2',
    ];

    /**
     * Get the harvest that owns the sample.
     */
    public function harvest(): BelongsTo
    {
        return $this->belongsTo(Harvest::class);
    }
} 