<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    public function getKeyName(){
        return "userID";
    }
    //protected $table = 'users';
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $primaryKey = 'userID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //'username',
        'firstname',
        'lastname',
        'email',
        'phone',
        'password',
        'accTypeID',
        'fieldID',
        'subFieldID',
        'location',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
