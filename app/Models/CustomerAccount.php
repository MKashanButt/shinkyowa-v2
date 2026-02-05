<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomerAccount extends Model
{
    protected $fillable = [
        'cid',
        'name',
        'company',
        'phone',
        'whatsapp',
        'address',
        'city',
        'country_id',
        'description',
        'email',
        'currency_id',
        'agent_id',
    ];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function stock(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function payment(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function point(): HasMany
    {
        return $this->hasMany(Point::class);
    }
}
