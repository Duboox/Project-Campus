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
    protected $fillable = ['name', 'last_name', 'city', 'residency', 'phone', 'fax', 'email', 'id_user'];
    protected $dates = ['deleted_at'];

    public function product()
    {
        return $this->hasMany('App\Product', 'id_client', 'id');
    }
}
