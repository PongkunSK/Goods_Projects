<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model
{
    protected $table = 'department';
    protected $primaryKey = 'Department_id';
    protected $allowedFields = ['Department_id', 'Dep_name', 'Dep_fullname'];

    // Get categories by department id
    public function getDepartment($depId)
    {
        return $this->where('Department_id', $depId)->findAll();
    }

    public function updateDepartment($equipmentId, $data)
    {
        return $this->update($equipmentId, $data);
    }

    public function deleteDepartment($equipmentId)
    {
        return $this->delete($equipmentId);
    }
}

