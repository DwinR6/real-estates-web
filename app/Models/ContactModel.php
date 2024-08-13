<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactModel extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $primaryKey = 'contact_id';

    protected $fillable = [
        'contact_id',
        'name',
        'email',
        'phone',
        'created_at',
        'updated_at',
    ];
}
