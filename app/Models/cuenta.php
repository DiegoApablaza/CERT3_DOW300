<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class cuenta extends Authenticable

{
    use HasFactory;

    protected $table = 'cuentas';
    protected $primaryKey = 'user';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['user', 'password', 'nombre', 'apellido', 'id_perfil'];

    public function perfil():BelongsTo
    {
        return $this->belongsTo(perfil::class);
    }

    public function imagenes()
    {
        return $this->hasMany('\App\Models\Imagen','cuenta_user','user');
    }

    public function registraUltimoLogin():void
    {
        $this->ultimo_login = Carbon::now();
        $this->save();
    }
    


   
}
