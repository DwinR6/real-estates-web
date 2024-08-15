<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceModel extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $primaryKey = 'service_id';

    protected $fillable = [
        'name',
        'description'
    ];

    public $timestamps = true;

    public function images()
    {
        return $this->morphMany(ImageModel::class, 'imageable');
    }
}
