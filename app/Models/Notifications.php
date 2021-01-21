<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    // Table Name
    protected $table = 'notifications';
    // Primary Key
    public $primaryKey = 'notificationID';
    public $timestamps = false;
}
