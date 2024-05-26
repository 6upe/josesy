<?php

namespace App\Models;

use CodeIgniter\Model;

class TrainingApplicationModel extends Model
{
    protected $table = 'training_applications';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'service', 'message', 'created_at'];
}
