<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneModel extends Model
{
    use HasFactory;

    protected $table = 'phones';

    protected $primaryKey = 'phone_id';

    //morphTo
    protected $fillable = [
        'phone_id',
        'phoneable_id',
        'phoneable_type',
        'phone_number',
        'created_at',
        'updated_at',
    ];
}
