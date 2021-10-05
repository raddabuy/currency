<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    public $table = 'currency';
    public $timestamps = false;

    protected $fillable = ['valuteID','numCode', 'charCode', 'name', 'value', 'date'];
}
