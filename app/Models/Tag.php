<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name_en',
        'name_ar',
        'slug',
        'created_by',
    ];


    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function admin(){
        return $this->belongsTo(Admin::class,'created_by');
    }
}
