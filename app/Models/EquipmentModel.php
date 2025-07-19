<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipmentModel extends Model
{
    protected $table = 'equipment';
    protected $primaryKey = 'Equipment_id';
    protected $allowedFields = [
        'Equipment_code',
        'Equipment_details',
        'Price',
        'Dep_id',
        'Category_id',
        'Sub_category_id',
        'Equipment_status',
        'Created_date',
        'Update_date'
    ];

    // Fetch equipment with optional filters and pagination
    public function getEquipment($filters = [], $limit = null, $offset = null)
    {
        $this->select('
            equipment.*, 
            department.Dep_name, 
            category.Category_name, 
            sub_category.Sub_category_name
        ');
        $this->join('department', 'equipment.Dep_id = department.Department_id', 'left');
        $this->join('category', 'equipment.Category_id = category.Category_id', 'left');
        $this->join('sub_category', 'equipment.Sub_category_id = sub_category.Sub_category_id', 'left');

        if (!empty($filters)) {
            $this->where($filters);
        }

        if ($limit !== null) {
            $this->limit($limit, $offset);
        }

        return $this->findAll();
    }

    // Update equipment by ID
    public function updateEquipment($equipmentId, $data)
    {
        return $this->update($equipmentId, $data);
    }

    // Save new equipment data
    public function saveEquipment($equipmentData)
    {
        return $this->save($equipmentData);
    }

    // Delete the equipment by ID
    public function deleteEquipment($equipmentId)
    {
        return $this->delete($equipmentId);
    }
}
