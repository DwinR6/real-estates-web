<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectModel extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $primaryKey = 'project_id';

    protected $fillable = [
        'project_id',
        'developer_id',
        'category_id',
        'name',
        'description',
        'lot_description',
        'infrastructure_description',
        'area_description',
        'location',
        'coordinates',
        'status',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id', 'category_id');
    }

    public function images()
    {
        //id de la tabla images = imageable_id
        //
        return $this->morphMany(ImageModel::class, 'imageable');
    }

    public function projectVideos()
    {
        return $this->hasMany(ProjectVideoModel::class, 'project_id', 'project_id');
    }

    public function projectDocuments()
    {
        return $this->hasMany(ProjectDocumentModel::class, 'project_id', 'project_id');
    }

    public function projectComments()
    {
        return $this->hasMany(ProjectCommentModel::class, 'project_id', 'project_id');
    }


    //un project puede tener muchos contactos, pero un contacto solo puede pertenecer a un project
    public function projectContacts()
    {
        //muchos a muchos
        return $this->hasMany(ProjectContactModel::class, 'project_id', 'project_id');
    }

    public function developer()
    {
        return $this->belongsTo(DeveloperModel::class, 'developer_id', 'developer_id');
    }
}
