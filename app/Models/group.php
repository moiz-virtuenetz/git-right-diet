<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class group extends Model
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
     * local scope
     */
    public function scopeStatus($query)
    {
        return $query->where('status', 1); // return only status with value 1
    }

    # get sub group with product id
    public function calSubgroup()
    {
        return $this->hasMany(SubGroup::class, 'group_id', 'id')->with('calMacro')->with('calCalorieList');
        // return $this->hasMany(SubGroup::class, 'id', 'group_id');
    }
}
