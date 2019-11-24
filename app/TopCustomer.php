<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TopCustomer extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_code','price'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 25;

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_code', 'code');
    }
}
