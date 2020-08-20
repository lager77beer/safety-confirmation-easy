<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Safety extends Model
{
    //「一気に保存可能」なカラムを指定
    protected $fillable = [
        'disaster_id', 'user_id', 'myself', 'contact_information'
    ];

    // $safty->disaster で safety に登録された disaster
    public function disaster()
    {
        return Disaster::find($this->disaster_id);
    }

    // $safty->user で safety に登録された user
    public function user()
    {
        return User::find($this->user_id);
    }

}
