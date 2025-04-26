<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeCategory extends Model
{
    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
}
