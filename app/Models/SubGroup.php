<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class SubGroup extends Model
{
    use HasFactory;

    /**
     * getter and setter
     */
    public function name(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ucfirst($value),
            set: fn ($value) => strtolower($value),
        );
    }

    /**
     * relations
     */
    public function group()
    {
        return $this->belongsTo(group::class);
    }
    # get macro with subgroup id
    public function calMacro()
    {
        return $this->hasMany(Macro::class, 'subgroup_id', 'id')->with('calCalorieList');
        // return $this->hasMany(SubGroup::class, 'id', 'group_id');
    }

    # get macro with subgroup id
    public function calCalorieList()
    {
        return $this->hasMany(CaloriesList::class, 'subgroup_id', 'id')
        ->with('calCaloriesField')->where('macro_id', 0);
        // return $this->hasMany(SubGroup::class, 'id', 'group_id');
    }
}
