<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['parent_id','name'];
    public function children()
    {
        return $this->hasMany('App\Models\Group','parent_id');
    }

    public function contacts()
{
    return $this->hasMany('App\Models\Contact');
}
}
