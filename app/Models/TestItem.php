<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestItem extends Model
{
    use HasFactory;
    // protected $fillable = ['items_array' => ['test_id', 'text', 'status']];
    protected $fillable = ['test_id', 'text', 'status'];
    public $timestamps = false;

    public function test(){
        return $this->belongsTo(Test::class);
    }

}
