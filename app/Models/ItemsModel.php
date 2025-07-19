<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemsModel extends Model
{
    protected $table = 'equipment';
    protected $primaryKey = 'Equipment_id';

    // Function to fetch items by Category
    public function getItemsByCategory($Category_id)
    {
        $query = $this->db->table($this->table)
            ->select('
                equipment.Equipment_code,
                equipment.Equipment_details,
                equipment.Price,
                equipment.File_path_pdf,
                equipment.Equipment_status,
                equipment.Created_date,
                equipment.Update_date,
                department.Dep_fullname,
                category.Category_name,
                sub_category.Sub_category_name
            ')
            ->join('department', 'equipment.Dep_id = department.Department_id', 'left')
            ->join('category', 'equipment.Category_id = category.Category_id', 'left')
            ->join('sub_category', 'equipment.Sub_category_id = sub_category.Sub_category_id', 'left')
            ->where('equipment.Category_id', $Category_id); // Filter by specific Category_id

        return $query->get()->getResultArray();
    }

    // Function to search items by term
    public function searchItems($searchTerm)
    {
        return $this->like('equipment_details', $searchTerm)
        ->select('
                equipment.Equipment_code,
                equipment.Equipment_details,
                equipment.Price,
                equipment.File_path_pdf,
                equipment.Equipment_status,
                equipment.Created_date,
                equipment.Update_date,
                department.Dep_fullname,
                category.Category_name,
                sub_category.Sub_category_name
            ')
            ->join('department', 'equipment.Dep_id = department.Department_id', 'left')
            ->join('category', 'equipment.Category_id = category.Category_id', 'left')
            ->join('sub_category', 'equipment.Sub_category_id = sub_category.Sub_category_id', 'left')
            ->findAll();
    }

    // Function to fetch items based on department and category
    public function fetchItemsByDepAndCat($Dep_id = null, $Category_id = null)
    {
        $query = $this->db->table($this->table)
            ->select('
                equipment.Equipment_code,
                equipment.Equipment_details,
                equipment.Price,
                equipment.File_path_pdf,
                equipment.Equipment_status,
                equipment.Created_date,
                equipment.Update_date,
                department.Dep_fullname,
                category.Category_name,
                sub_category.Sub_category_name
            ')
            ->join('department', 'equipment.Dep_id = department.Department_id', 'left')
            ->join('category', 'equipment.Category_id = category.Category_id', 'left')
            ->join('sub_category', 'equipment.Sub_category_id = sub_category.Sub_category_id', 'left');

        // Filter by department if provided
        if ($Dep_id) {
            $query->where('equipment.Dep_id', $Dep_id);
        }

        // Filter by category if provided
        if ($Category_id) {
            $query->where('equipment.Category_id', $Category_id);
        }

        return $query->get()->getResultArray();
    }

    // Function to fetch all items without Category filter
    public function fetchAllItems()
    {
        // Fetch all items from the equipment table, joining with other tables as needed
        $query = $this->db->table($this->table)
            ->select('
                equipment.Equipment_code,
                equipment.Equipment_details,
                equipment.Price,
                equipment.File_path_pdf,
                equipment.Equipment_status,
                equipment.Created_date,
                equipment.Update_date,
                department.Dep_fullname,
                category.Category_name,
                sub_category.Sub_category_name
            ')
            ->join('department', 'equipment.Dep_id = department.Department_id', 'left')
            ->join('category', 'equipment.Category_id = category.Category_id', 'left')
            ->join('sub_category', 'equipment.Sub_category_id = sub_category.Sub_category_id', 'left');

        return $query->get()->getResultArray();
    }

    // Function to update the status
    public function updateStatus($id, $data)
    {
        try {
            return $this->db->table($this->table)->update($data, ['Equipment_id' => $id]);
        } catch (\Exception $e) {
            log_message('error', 'Failed to update status: ' . $e->getMessage());
            return false;
        }
    }
    
}
