<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    // Table Name
    protected $table = 'weight';
    // Primary Key
    public $primaryKey = 'weightID';
    public $timestamps = false;

    protected $fillable = [
        'weightID','weightName',
    ];
}
