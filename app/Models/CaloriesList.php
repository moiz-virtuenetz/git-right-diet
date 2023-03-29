<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;

class CaloriesList extends Model
{
    use HasFactory;

   

    /**
     * getter and setter
     */
    public function food_name(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ucfirst($value),
            set: fn ($value) => strtolower($value),
        );
    }

    /**
     * global scope
     */
    // protected static function booted()
    // {
    //     static::addGlobalScope('active', function (Builder $builder) {
    //         $builder->where('status', '1');
    //     });
    // }


    /**
     * relations
     */

    public function macro()
    {
        return $this->belongsTo(Macro::class);
    }

    public function group()
    {
        return $this->belongsTo(group::class);
    }

    public function subgroup()
    {
        return $this->belongsTo(SubGroup::class);
    }

    public function servingsize()
    {
        return $this->belongsTo(ServingSize::class, 'serving', 'id');
    }

    public function macros()
    {
        return $this->hasMany(CaloriesField::class, 'calorie_id', 'id')->with('macro');
    }

    # get calorie with macro id
    public function calCaloriesField()
    {
        return $this->hasMany(CaloriesField::class, 'calorie_id', 'id')->with('calCountas');
        // return $this->belongsTo(CaloriesField::class, 'id', 'calorie_id');
    }
    # get servingsizes with serving 
    public function calServingSize()
    {
        return $this->belongsTo(ServingSize::class, 'serving', 'id');
        // return $this->hasMany(SubGroup::class, 'id', 'group_id');
    }
}
