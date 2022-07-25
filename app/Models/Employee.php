<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'phone',
        'practice_id',
    ];

    /**
     * Get the practice info of the employee
     */
    public function practice()
    {
        return $this->belongsTo(Practice::class, 'practice_id', 'id');
    }
}
