<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Caffeinated\Shinobi\Traits\ShinobiTrait;

class Product extends Model
{
    use Notifiable, SoftDeletes, ShinobiTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['mc', 'name', 'model', 'serial_number', 'internal_code', 'magnitude', 'date_last_calibration', 'date_control_calibration', 'status', 'delivery_status', 'others', 'id_client', 'id_fabricator', 'id_user'];
    protected $dates = ['deleted_at'];

    public function client()
    {
        return $this->belongsTo('App\Client', 'id_client', 'id');
    }

    public function fabricator()
    {
        return $this->belongsTo('App\Fabricator', 'id_fabricator', 'id');
    }

}
