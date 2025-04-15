<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;


    protected $fillable = [
        'image',
        'title',
        'url',
        'owner',
        'owner_phone',
        'price',
        'date',
        'time',
        'notes',
        'visit',
        'created_by',
        'ad_place_id',
        'created_at',
        'updated_at',
    ];

    public function admin(){
        return $this->belongsTo(Admin::class,'created_by');
    }

    // public function adplace(){
    //     return $this->belongsTo(AdPlace::class);
    // }

    public function adplace()
{
    return $this->belongsTo(AdPlace::class, 'ad_place_id');
}


}
