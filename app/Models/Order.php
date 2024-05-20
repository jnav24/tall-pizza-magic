<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'order_status_id',
    ];

    public static function boot(): void
    {
        parent::boot();

        self::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Str::uuid();
            }
        });
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/y H:i:s');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    protected function casts(): array
    {
        return [
            'uuid' => 'string',
        ];
    }
}
