<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Person extends Model
{
    use HasFactory;

    protected $table = 'representative_people';


    public function map_data(): BelongsTo
    {
        return $this->belongsTo(MapData::class, 'symbol', 'symbol');
    }

    public function representativesDepartments(): BelongsTo
    {
        return $this->belongsTo(Department::class, "department", "department");
    }
}
