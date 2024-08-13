<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachinaryModel extends Model
{
    use HasFactory;

    protected $table = 'machinaries';

    protected $primaryKey = 'machinary_id';

    protected $fillable = [
        'name',
        'description',
    ];

    public $timestamps = true;

    public function images()
    {
        //morphMany
        return $this->morphMany(ImageModel::class, 'imageable');
    }
}
