<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = 'field_of_practice';

    protected $fillable = [
        'tag',
    ];

    /**
     * Get the assigned fields of practice.
     */
    public function practices()
    {
        return $this->hasMany(PracticeField::class, 'field_of_practice_id', 'id');
    }
}
