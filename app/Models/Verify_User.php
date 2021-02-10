<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verify_User extends Model
{
    // Table Name
    protected $table = 'verify_user';
    // Primary Key
    public $primaryKey = 'userID';
    public $timestamps = false;
    protected $fillable = ['firstname','lastname','email','phone','location','active','accTypeID','fieldID','subFieldID'];

}
