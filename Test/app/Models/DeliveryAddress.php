<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DeliveryAddress extends Model
{
    // Table Name
    protected $table = 'delivery_address';
    // Primary Key
    public $primaryKey = 'addressID';
    public $timestamps = false;

    protected $fillable = [
        'addressID','orderID','label','address','phone'
    ];

}
