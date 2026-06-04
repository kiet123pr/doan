<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use Notifiable;
    protected $table="category";
    public $timestamps = false;

    protected $fillable = [
        'category'
    ];
}
