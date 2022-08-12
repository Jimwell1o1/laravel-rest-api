<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'name',
        'model'
    ];


    public function customers()
    {

        return $this->belongsTo(Customer::class); 
    }
}
