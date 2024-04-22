<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'description', 'category_id', 'price', 'image'];
    
    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
    
    public function user() {
        return $this->belongsTo('App\Models\User');
    }    

    public function isLikedBy($user){
        $liked_users_ids = $this->likedUsers->pluck('id');
        $result = $liked_users_ids->contains($user->id);
        return $result;
    }
    
    public function likes() {
        return $this->hasMany('App\Models\Like');
    }
    
    public function likedUsers(){
        return $this->belongsToMany(User::class, 'likes');
    }
    
    public function isSoldout() {
        return $this->hasMany('App\Models\Order')->exists();
    }
}
