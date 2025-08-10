<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clas extends Model
{
    use HasFactory;

    
    protected $table = 'clas';

    protected $fillable = [
        'name',
    ];

     public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the count of active users in this class.
     */
    public function getActiveUsersCountAttribute()
    {
        return $this->users()->where('activate', 1)->count();
    }

    /**
     * Get the count of inactive users in this class.
     */
    public function getInactiveUsersCountAttribute()
    {
        return $this->users()->where('activate', 2)->count();
    }

    /**
     * Get the total users count in this class.
     */
    public function getTotalUsersCountAttribute()
    {
        return $this->users()->count();
    }
    
}
