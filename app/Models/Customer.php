<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Hash;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'is_active',
        'is_verified',

    ];

    /**
     * Boot the model and apply a global scope to filter customers where user_type = 'user'.
     */
    protected static function boot()
    {
        parent::boot();

        // Apply global scope to filter 'user_type' = 'user'
        static::addGlobalScope('userType', function ($query) {
            $query->where('user_type', 'user');
        });

        static::creating(function ($customer) {
            if (empty($customer->password)) {
                $customer->password = Hash::make('12345678');
            }
        });

    }

    public function full_name()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function default_customer_address(): HasOne
    {
        return $this->hasOne(CustomerAddress::class, 'user_id');
    }

    public function customer_addresses(): HasMany
    {
        return $this->hasMany(CustomerAddress::class, 'user_id');
    }
}
