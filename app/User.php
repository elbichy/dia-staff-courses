<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses(){
        return $this->belongsToMany('App\Course');
    }

    public function getFullnameAttribute($value)
    {
        return ucwords($value);
    } 
    public function getGenderAttribute($value)
    {
        return ucfirst($value);
    } 
    public function getCategoryAttribute($value)
    {
        return ucfirst($value);
    }
    public function getDirectorateAttribute($value)
    {
        return ucwords($value);
    } 
}
