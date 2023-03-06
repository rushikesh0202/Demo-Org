<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{     
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'dept_id',
        'password',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id', 'id');
    }        

    public function emp_details()
    {
        return $this->hasMany(EmpDetails::class, 'emp_id', 'id');
    }            
}
