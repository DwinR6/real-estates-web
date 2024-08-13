<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailModel extends Model
{
    use HasFactory;

    protected $table = 'emails';

    protected $primaryKey = 'email_id';

    protected $fillable = [
        'email_id',
        'emailable_id',
        'emailable_type',
        'email_address',
        'created_at',
        'updated_at',
    ];
}
