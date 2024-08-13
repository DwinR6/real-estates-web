<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagerModel extends Model
{
    use HasFactory;

    protected $table = 'managers';

    protected $primaryKey = 'manager_id';

    protected $fillable = [
        'manager_id',
        'first_name',
        'last_name',

    ];

    public function phones()
    {
        return $this->morphMany(PhoneModel::class, 'phoneable');
    }

    //emails is a polymorphic relationship
    public function emails()
    {
        return $this->morphMany(EmailModel::class, 'emailable', 'emailable_type', 'emailable_id',  'manager_id');
    }

    public function developers()
    {
        return $this->belongsToMany(DeveloperModel::class, 'developer_managers', 'manager_id', 'developer_id');
    }
}
