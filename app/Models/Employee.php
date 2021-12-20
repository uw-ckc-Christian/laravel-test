<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model {
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = array('first_name', 'last_name', 'company_id', 'email', 'phone');

    public function company() {
        return $this->belongsTo('App\Models\Company');
    }
}
