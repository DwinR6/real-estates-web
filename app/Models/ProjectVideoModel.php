<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectVideoModel extends Model
{
    use HasFactory;

    protected $table = 'project_videos';

    protected $primaryKey = 'project_video_id';

    protected $fillable = [
        'project_video_id',
        'project_id',
        'video_id',
        'created_at',
        'updated_at',
    ];

    public function project()
    {
        return $this->belongsTo(ProjectModel::class, 'project_id', 'project_id');
    }

    public function video()
    {
        return $this->belongsTo(VideoModel::class, 'video_id', 'video_id');
    }

    
}
