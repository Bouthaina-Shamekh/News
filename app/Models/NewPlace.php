<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewPlace extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name_en',
        'name_ar',
    ];


    public function nw()
    {
        return $this->hasMany(Nw::class);
    }

}
