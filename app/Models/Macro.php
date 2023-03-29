<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Macro extends Model
{
    use HasFactory;

    public function name():Attribute{
        return new Attribute(
            get: fn($value) => ucfirst($value),
            set: fn($value) => strtolower($value),
        );
    }

    /**
     * relations
     */
     public function subgroup()
     {
         return $this->belongsTo(SubGroup::class);
     }

     # get calorie with macro id
public function calCalorieList()
{
    return $this->hasMany(CaloriesList::class, 'macro_id', 'id')->with('calCaloriesField')
    ->with('calServingSize');
    // return $this->hasMany(SubGroup::class, 'id', 'group_id');
}
    
}
