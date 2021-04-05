<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    // Table Name
    protected $table = 'payments';
    // Primary Key
    public $primaryKey = 'paymentID';
    public $timestamps = false;
}
