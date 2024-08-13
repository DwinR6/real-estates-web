<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDeveloperModel extends Model
{
    use HasFactory;

    protected $table = 'project_developers';

    protected $primaryKey = 'project_developer_id';

    protected $fillable = [
        'project_developer_id',
        'project_id',
        'developer_id',
        'created_at',
        'updated_at',
    ];

    public function project()
    {
        return $this->belongsTo(ProjectModel::class, 'project_id', 'project_id');
    }

    public function developer()
    {
        return $this->belongsTo(DeveloperModel::class, 'developer_id', 'developer_id');
    }
}
