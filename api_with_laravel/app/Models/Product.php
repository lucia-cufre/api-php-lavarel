<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;


class Product extends Model
{
    use HasFactory, Uuid;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'category',
        'status',
        'quantity',
        'created_at',
        'update_at',
        'deleted_at'
    ];
}