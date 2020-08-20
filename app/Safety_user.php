<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Safety_user extends Model
{
    // $safety_user->safety で disaster_idとuser_idをキーに　Safety 
    public function safety()
    {
        return Safety::where('disaster_id', $this->disaster_id)->where('user_id', $this->user_id)->first();
    }

}
