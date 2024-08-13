<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoModel extends Model
{
    use HasFactory;

    protected $table = 'videos';

    protected $primaryKey = 'video_id';

    protected $fillable = [
        'video_id',
        'name',
        'url',
        'created_at',
        'updated_at',
    ];
}
