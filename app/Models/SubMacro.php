<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class SubMacro extends Model
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

     public function group()
     {
         return $this->belongsTo(group::class);
     }
}
