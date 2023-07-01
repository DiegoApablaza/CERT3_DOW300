<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imagen extends Model
{
    use HasFactory;
    protected $table = 'imagenes';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $timestamps = false;

    public function cuenta()
    {
        return $this->belongsTo('App\Models\Cuenta');
    }
}
