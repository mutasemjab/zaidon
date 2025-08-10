<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'salary' => 'decimal:2',
    ];

    /**
     * Get the expenses for the driver.
     */
    public function expenses()
    {
        return $this->hasMany(Expenses::class);
    }
}
