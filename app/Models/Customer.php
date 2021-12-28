<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Customer extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

//    protected $guard_name = 'web';

    protected $table = 'customers';
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'customer_name',
        'customer_tel',
        'customer_email',
        'customer_address',
        'customer_account',
        'customer_group'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $auditInclude = [
        'customer_name',
        'customer_tel',
        'customer_email',
        'customer_address',
        'customer_account',
        'customer_group'
    ];


    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
