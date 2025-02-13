<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
    ];


    public function articale()
    {
        return $this->hasMany(Artical::class);
    }

    public function nw()
    {
        return $this->hasMany(Nw::class);
    }
}
