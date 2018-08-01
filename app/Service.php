<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Caffeinated\Shinobi\Traits\ShinobiTrait;

class Service extends Model
{
    use Notifiable, SoftDeletes, ShinobiTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date_delivery', 'date_return', 'id_client', 'id_product', 'id_user'];
    protected $dates = ['deleted_at'];

    public function client()
    {
        return $this->hasOne('App\Client', 'id', 'id_client');
    }

    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'id_product');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'id_user');
    }
}
