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
        'user_id', 'status', 'jam_masuk', 'jam_keluar'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
