<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
      protected $guarded = [];

       protected $casts = [
        'amount' => 'decimal:2',
    ];

    /**
     * Get the expense type that owns the expense.
     */
    public function typeExpense()
    {
        return $this->belongsTo(TypeExpenses::class,'type_expenses_id');
    }

      public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the teacher that owns the expense.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Get the driver that owns the expense.
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    /**
     * Get the related person name (user, teacher, or driver).
     */
    public function getRelatedPersonAttribute()
    {
        if ($this->user) {
            return $this->user->name . ' (' . __('messages.Student') . ')';
        } elseif ($this->teacher) {
            return $this->teacher->name . ' (' . __('messages.Teacher') . ')';
        } elseif ($this->driver) {
            return $this->driver->name . ' (' . __('messages.Driver') . ')';
        }
        
        return __('messages.General Expense');
    }

    /**
     * Get the related person type.
     */
    public function getPersonTypeAttribute()
    {
        if ($this->user) {
            return 'user';
        } elseif ($this->teacher) {
            return 'teacher';
        } elseif ($this->driver) {
            return 'driver';
        }
        
        return 'general';
    }

}
