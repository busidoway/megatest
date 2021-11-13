<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestBoxTestRel extends Model
{
    use HasFactory;
    protected $fillable = ['test_box_id', 'test_id'];
}
