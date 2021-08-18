<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    //use HasFactory;
    protected $fillable = ['numero'];
    public $timestamps = false;
    
    public function temporada()
    {
        return $this->belongsTo(Temporada::class);
    }
    
}
