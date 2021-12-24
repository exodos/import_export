<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

class Group extends Model
{
    use HasFactory, Auditable;

    protected $table = 'groups';

    protected $fillable = [
        'id',
        'group_name'
    ];


    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $auditInclude = [
        'id',
        'group_name'
    ];
}
