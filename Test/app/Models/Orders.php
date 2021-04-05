<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    // Table Name
    protected $table = 'orders';
    // Primary Key
    public $primaryKey = 'orderID';
    public $timestamps = false;
}
