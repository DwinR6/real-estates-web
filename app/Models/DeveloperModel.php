<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeveloperModel extends Model
{
    use HasFactory;

    protected $table = 'developers';

    protected $primaryKey = 'developer_id';

    protected $fillable = [
        'developer_id',
        'name',
        'short_name',
        'large_name',
        'description',
        'logo',
    ];

    public function phones()
    {
        return $this->morphMany(PhoneModel::class, 'phoneable');
    }

    //emails is a polymorphic relationship
    public function emails()
    {
        return $this->morphMany(EmailModel::class, 'emailable', 'emailable_type', 'emailable_id',  'developer_id');
    }

    public function projects()
    {
        return $this->belongsToMany(ProjectModel::class, 'project_developers', 'developer_id', 'project_id');
    }

    public function managers()
    {
        return $this->belongsToMany(ManagerModel::class, 'developer_managers', 'developer_id', 'manager_id');
    }
}
