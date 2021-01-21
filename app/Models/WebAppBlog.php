<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebAppBlog extends Model
{
    // Table Name
    protected $table = 'web_app_blog';
    // Primary Key
    public $primaryKey = 'blogID';
    public $timestamps = true;
}
