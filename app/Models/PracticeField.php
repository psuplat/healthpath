<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticeField extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = 'practice_field_of_practice';

    protected $fillable = [
        'practice_id',
        'field_of_practice_id',
    ];
}
