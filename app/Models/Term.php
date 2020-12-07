<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    protected $fillable = ['device_id', 'category_id',  'term'];

    public function device()
    {
        return $this->belongsTo('App\Models\Device')->withDefault();
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category')->withDefault();
    }
}
