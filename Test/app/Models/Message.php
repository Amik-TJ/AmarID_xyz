<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // Table Name
    protected $table = 'message';
    // Primary Key
    public $primaryKey = 'messageID';
    public $timestamps = false;
}
