<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Genre;

class Album extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'thumb', 'release_yaer'];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function genres(){
        return $this->belongsToMany(Genre::class);
    }
}
