<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;
    // Table Name
    protected $table = 'faq';
    // Primary Key
    public $primaryKey = 'faqID';
    public $timestamps = false;
    protected $fillable = [
        'faqID','question','answer',
    ];
}
