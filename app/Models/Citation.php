<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Citation extends Model
{
    protected $fillable = [
        'texte',
        'author',
        'user_id'
    
        
    ];
    public function user (){
     
        return $this->belongsTo(User::class);
    }
   
}
