<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'comp_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'comp_id', 'id');
    }    

    public function employee()
    {
        return $this->hasMany(Employee::class, 'dept_id', 'id');
    }        
}