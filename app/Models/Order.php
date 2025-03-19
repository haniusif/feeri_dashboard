<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_reference',
        'order_status_id',
        'user_id',
        'cod_amount',
        'pickup_reference',
        'pickup_name',
        'pickup_phone_number',
        'pickup_country_id',
        'pickup_city_id',
        'pickup_neighbourhood_id',
        'pickup_address',
        'pickup_latitude',
        'pickup_longitude',
        'pickup_time',
        'dropoff_reference',
        'dropoff_name',
        'dropoff_phone_number',
        'dropoff_country_id',
        'dropoff_city_id',
        'dropoff_neighbourhood_id',
        'dropoff_address',
        'dropoff_latitude',
        'dropoff_longitude',
        'dropoff_time',
    ];

    public function order_status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, );
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

}
