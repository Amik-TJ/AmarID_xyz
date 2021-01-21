<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    // Table Name
    protected $table = 'feedbacks';
    // Primary Key
    public $primaryKey = 'feedbackID';
    public $timestamps = false;

    protected $fillable = [
        'feedbackID','byID','forID','message','time'
    ];
}
