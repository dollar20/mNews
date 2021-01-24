<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
	protected $fillable = [
        'url',
        'title',
        'user_id',
        'description',
    ];
	
	public function comments()
    {
        return $this->hasMany(Comment::class);
    }
	public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
