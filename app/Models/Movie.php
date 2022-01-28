<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'director', 'description', 'poster', 'length', 'status'];

    protected $table = 'movies';

    public $timestamps = false;

}