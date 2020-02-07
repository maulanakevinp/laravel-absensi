<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Present extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'tanggal', 'keterangan', 'jam_masuk', 'jam_keluar'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
