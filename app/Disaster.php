<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disaster extends Model
{
    //「一気に保存可能」なカラムを指定
    protected $fillable = [
        'name',
    ];

    //disasterが持つsafetys
    public function safeties()
    {
        return $this->hasMany(Safety::class)->orderBy('updated_at', 'desc');
    } 
    
    //多対多（$disaster->users で safety に登録された user 達)
    public function users()
    {
        return $this->belongsToMany(User::class, 'safeties', 'disaster_id', 'user_id')->withTimestamps();
    }

    //該当userのsafetyが登録済みか？メソッド
    public function has_safety($user_id)
    {
        return $this->users()->where('user_id', $user_id)->exists();
    }

}
