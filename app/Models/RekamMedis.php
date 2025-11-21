<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    protected $fillable = ['anamnesa', 'temuan_klinis', 'diagnosa', 'dokter_pemeriksa', 'idreservasi_dokter'];
    public function roleUser()
    {
        return $this->belongsTo(RoleUser::class, 'idrole_user', 'dokter_pemeriksa');
    }

}
