<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name_en',
        'name_ar',
        'image',
        'created_by',
    ];



    public function admin(){
        return $this->belongsTo(Admin::class,'created_by');
    }

    public function nw()
    {
        return $this->hasMany(Nw::class);
    }

    public function article()
    {
        return $this->hasMany(Artical::class);
    }
}
