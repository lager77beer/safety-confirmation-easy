<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    //「一気に保存可能」なカラムを指定
    protected $fillable = [
        'name', 'email', 'password','phone','admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    //userが持つsafeties
    public function safeties()
    {
        return $this->hasMany(Safety::class);
    } 
    
    //直近のsafety１つを取得
    public function latestSafety()
    {
        return Safety::where('user_id',$this->id)->orderBy('updated_at', 'desc')->first();
    } 
    

}
