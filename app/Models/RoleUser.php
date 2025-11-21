<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';
    protected $primaryKey = 'idrole_user';
    protected $fillable = ['iduser', 'idrole', 'status']; 
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }
    public function temuDokter()
    {
        return $this->hasMany(TemuDokter::class, 'idrole_user', 'idrole_user');
    }
    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'dokter_pemeriksa', 'idrole_user');
    }
}

