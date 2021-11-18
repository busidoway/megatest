<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $fillable = ['test_box_id', 'name', 'note'];

    public function test_box(){
        return $this->belongsTo(TestBox::class);
    }

    public function test_items(){
        return $this->hasMany(TestItem::class);
    }

}
