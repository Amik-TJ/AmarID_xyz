<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    // Table Name
    protected $table = 'blogs';
    // Primary Key
    public $primaryKey = 'blogID';
    public $timestamps = false;
    protected $fillable = [
        'blogID','title','imgUrl','content','time',
    ];
}
