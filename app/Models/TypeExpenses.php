<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeExpenses extends Model
{
    use HasFactory;
    protected $table = 'type_expenses';

      protected $guarded = [];

       public function expenses()
    {
        return $this->hasMany(Expenses::class);
    }

    /**
     * Get the total amount for this expense type.
     */
    public function getTotalAmountAttribute()
    {
        return $this->expenses()->sum('amount');
    }
}
