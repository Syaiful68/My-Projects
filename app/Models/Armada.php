<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Armada extends Model
{
    use HasFactory;
    protected $table = 'tb_armada';
    protected $guarded = ['id'];


    public function record()
    {
        return $this->hasMany(Record::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
