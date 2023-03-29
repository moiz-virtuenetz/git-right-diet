<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaloriesField extends Model
{
    use HasFactory;

    protected $fillable = [
        'calorie_id'
    ];

    public function macro()
    {
        return $this->belongsTo(Macro::class);
    }

     # get countas (macro) with maroc_id 
     public function calCountas()
     {
         return $this->belongsTo(Macro::class, 'macro_id', 'id');
     }
    
}
