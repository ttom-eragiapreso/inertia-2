<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Album extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'thumb', 'release_yaer'];

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
