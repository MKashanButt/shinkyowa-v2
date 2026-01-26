<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stock extends Model
{
    protected $fillable = [
        'sid',
        'thumbnail',
        'images',
        'chassis',
        'make_id',
        'model',
        'year',
        'mileage',
        'fob',
        'cnf',
        'currency_id',
        'doors',
        'transmission',
        'body_type_id',
        'fuel',
        'category_id',
        'country_id',
        'color',
        'features',
        'customer_account_id',
        'agent_id',
    ];

    public function make(): BelongsTo
    {
        return $this->belongsTo(Make::class);
    }

    public function bodyType(): BelongsTo
    {
        return $this->belongsTo(BodyType::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function customerAccount(): BelongsTo
    {
        return $this->belongsTo(CustomerAccount::class);
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function payment(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function document(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function shipment(): BelongsToMany
    {
        return $this->belongsToMany(Shipment::class);
    }

    public function getDepositAttribute()
    {
        return $this->payment->sum('amount');
    }
}
