<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;



class User extends Authenticatable
{
   use HasApiTokens, HasFactory, Notifiable;

   /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $guarded = [];

   protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'annual_installment' => 'decimal:2',
        'past_balance' => 'decimal:2',
        'activate' => 'integer',
    ];

    /**
     * Get the class that the user belongs to.
     */
    public function clas()
    {
        return $this->belongsTo(Clas::class);
    }

    /**
     * Get the activation status text.
     */
    public function getActivationStatusAttribute()
    {
        return $this->activate == 1 ? __('messages.Active') : __('messages.Inactive');
    }

    /**
     * Get the activation status badge class.
     */
    public function getActivationBadgeClassAttribute()
    {
        return $this->activate == 1 ? 'badge bg-success' : 'badge bg-danger';
    }

    /**
     * Scope for active users.
     */
    public function scopeActive($query)
    {
        return $query->where('activate', 1);
    }

    /**
     * Scope for inactive users.
     */
    public function scopeInactive($query)
    {
        return $query->where('activate', 2);
    }


}
