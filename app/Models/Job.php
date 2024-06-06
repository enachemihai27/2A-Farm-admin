<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'positions_of_employment';

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            History::create([
                'action' => 'created',
                'table_name' => 'positions_of_employment',
                'user_name' => auth()->user()->name . '- Admin',
                'new_data' => json_encode($model->toArray())
            ]);
        });

        static::updated(function ($model) {
            History::create([
                'action' => 'updated',
                'table_name' => 'positions_of_employment',
                'user_name' => auth()->user()->name . '- Admin',
                'old_data' => json_encode($model->getOriginal()),
                'new_data' => json_encode($model->toArray())
            ]);
        });
    }
}
