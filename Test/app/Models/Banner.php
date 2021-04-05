<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    // Table Name
    protected $table = 'banners';
    // Primary Key
    public $primaryKey = 'bannerID';
    public $timestamps = false;

    protected $fillable = [
        'bannerID','banner_title','imgURL',
    ];
}
