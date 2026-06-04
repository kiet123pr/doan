<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Blog extends Model
{
    use Notifiable;
    protected $table="blog";
    public $timestamps = false;

    protected $fillable = [
        'title', 'image', 'content'
    ];
}
