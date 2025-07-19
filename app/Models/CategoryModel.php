<?php

namespace App\Models;
use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'category'; // Category table
    protected $primaryKey = 'Category_id'; // Primary key
    protected $allowedFields = ['Category_id', 'Dep_id', 'Category_name', 'Category_details', 'Icon_path', 'Category_color']; // Allowed fields

    // Method to get category along with department fullname
    public function getCategoriesWithDepartmentFullname()
    {
        // Joining category and department tables on Dep_id
        $builder = $this->db->table('category');
        $builder->select('category.*, department.Dep_fullname'); // Selecting category fields and department full name
        $builder->join('department', 'department.Department_id = category.Dep_id', 'left'); // Left join to get department fullname
        return $builder->get()->getResultArray(); // Execute and return results as array
    }
    
    // Get categories by department id
    public function getCategoriesByDepartment($depId)
    {
        return $this->where('Dep_id', $depId)->findAll();
    }

    // Method to get category along with department fullname
    public function getCategoriesWithDepartmentFullnameonid($equipmentId)
    {
        // Joining category and department tables on Dep_id
        $builder = $this->db->table('category');
        $builder->select('category.*, department.Dep_fullname'); // Selecting category fields and department full name
        $builder->join('department', 'department.Department_id = category.Dep_id', 'left'); // Left join to get department fullname
        return $this->get()->where('Category_id', $equipmentId); // Execute and return results as array
    }

    public function updateCategory($equipmentId, $data)
    {
        return $this->update($equipmentId, $data);
    }

    // Delete the equipment by ID
    public function deleteCategory($equipmentId)
    {
        return $this->delete($equipmentId);
    }
}
