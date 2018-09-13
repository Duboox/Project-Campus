<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Caffeinated\Shinobi\Traits\ShinobiTrait;

class Client extends Model
{
    use Notifiable, SoftDeletes, ShinobiTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'rubro', 'last_name', 'city', 'residency', 'zone', 'phone', 'fax', 'email', 'web_page', 'id_user'];
    protected $dates = ['deleted_at'];

    public function product()
    {
        return $this->hasMany('App\Product', 'id_client', 'id');
    }
}
