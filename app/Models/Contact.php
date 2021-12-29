<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id','name', 'email','phone'
    ];
    
    public function group(){
        return $this->belongsTo('App\Models\Group');
    }
    
}
