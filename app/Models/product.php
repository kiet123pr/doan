<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class product extends Model
{
    use Notifiable;
    protected $table = "product";
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'name',
        'price',
        'id_category',
        'id_brand',
        'status',
        'sale',
        'company',
        'avatar'
    ];
}
