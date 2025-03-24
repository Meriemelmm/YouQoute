<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'tag_name'
       
    
        
    ];
    public function Citations(){
        return $this->belongsToMany(Citation::class,'tag_Citation');
    }
}

