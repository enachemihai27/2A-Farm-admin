<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','action', 'table_name', 'old_data', 'new_data'];

    protected $table = 'positions_of_employment_table_history';
}
