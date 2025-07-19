<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, "project_members");
    }

    public function leader(){
        return $this->belongsTo(User::class, "leader_id");
    }
}
