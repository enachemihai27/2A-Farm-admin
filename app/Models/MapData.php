<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MapData extends Model
{
    use HasFactory;

    protected $table = 'map_data';

    protected $primaryKey = 'primary_key';


    public function person(): HasOne
    {
        return $this->hasOne(Person::class, 'symbol', 'symbol');
    }

}
