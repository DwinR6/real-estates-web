<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectContactModel extends Model
{
    use HasFactory;

    protected $table = 'project_contacts';

    protected $primaryKey = 'project_contact_id';

    protected $fillable = [
        'project_contact_id',
        'project_id',
        'contact_id',
        'created_at',
        'updated_at',
    ];

    public function project()
    {
        return $this->belongsTo(ProjectModel::class, 'project_id', 'project_id');
    }

    public function contact()
    {
        return $this->belongsTo(ContactModel::class, 'contact_id', 'contact_id');
    }
    
}
