<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageModel extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'image_id',
        'imageable_id',
        'imageable_type',
        'name',
        'path',
        'created_at',
        'updated_at',
    ];

    public function project()
    {
        return $this->belongsTo(ProjectModel::class, 'project_id');
    }
    /*
        create script mysql

        CREATE TABLE `project_images` (
          `project_image_id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(255) NOT NULL,
          `path` varchar(255) NOT NULL,
          `project_id` int(11),
          PRIMARY KEY (`project_image_id`),
          KEY `project_id` (`project_id`),
          CONSTRAINT `project_images_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

    */
}
