<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpDetails extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'emp_id', 'email', 'phone', 'mobile', 'address'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id', 'id');
    }           
}