<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Follow;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    //リレーションを設定
    public function items() {
        return $this->hasMany(Item::Class);
    }
    
    public function scopeRecommend($query, $self_id) {
        return $query->where('id', '!=', $self_id)->latest();
    }
    
    public function likes() {
        return $this->hasMany(Like::class);
    }
    
    public function likeItems() {
        return $this->belongsToMany(Item::class, 'likes')->orderBy('likes.created_at', 'desc');
    }
    
    public function orderItems() {
        return $this->belongsToMany(Item::class, 'orders');
    }
    
    public function users() {
        return $this->hasMany(User::class);
    }
    
    public function item_users() {
        return $this->belongsToMany(Item::class, 'items', 'item_id', 'item_id');
    }
    
    public function item_ids() {
        return $this->belongsToMany(Item::class, 'items', 'item_id', 'item_id');
    }
    
}
