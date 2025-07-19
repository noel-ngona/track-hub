<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    public function reporter(){
        return $this->belongsTo(User::class, "reporter_id");   
    }

    public function assignee(){
        return $this->belongsTo(User::class, "assignee_id");   
    }
}
