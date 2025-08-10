<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

      protected $guarded = [];

       protected $casts = [
        'salary' => 'decimal:2',
    ];

    /**
     * Get the expenses for the teacher.
     */
    public function expenses()
    {
        return $this->hasMany(Expenses::class);
    }
}
