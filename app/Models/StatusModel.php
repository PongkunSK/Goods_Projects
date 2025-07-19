<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusModel extends Model
{
    protected $table = 'status';
    protected $primaryKey = 'Status_id';
    protected $allowedFields = ['Status_id', 'Status_name'];

   
}

