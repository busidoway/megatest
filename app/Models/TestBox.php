<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestBox extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'note'];

    public function tests(){
        return $this->hasMany(Test::class);
    }

}
