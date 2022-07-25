<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'email',
        'website_url',
        'logo',
    ];

    /**
     * Get the employees for the practice.
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    /**
     * Get the assigned fields of practice.
     */
    public function fields()
    {
        return $this->hasMany(PracticeField::class);
    }
}
