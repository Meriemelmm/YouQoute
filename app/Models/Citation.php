<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Citation extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'texte',
        'author',
        'user_id'
    
        
    ];
    public function user (){
     
        return $this->belongsTo(User::class);
    }
   
}
