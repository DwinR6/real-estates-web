<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImageModel extends Model
{
    use HasFactory;

    protected $table = 'project_images';

    protected $primaryKey = 'project_image_id';

    protected $fillable = [
        'project_image_id',
        'project_id',
        'image_id',
        'created_at',
        'updated_at',
    ];

    public function project()
    {
        return $this->belongsTo(ProjectModel::class, 'project_id', 'project_id');
    }

    public function image()
    {
        return $this->belongsTo(ImageModel::class, 'image_id', 'image_id');
    }


}
