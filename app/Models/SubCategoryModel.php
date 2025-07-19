<?php 
namespace App\Models;

use CodeIgniter\Model;

class SubCategoryModel extends Model
{
    protected $table = 'sub_category';
    protected $primaryKey = 'Sub_category_id';
    protected $allowedFields = ['Sub_category_id', 'Sub_category_name', 'Category_id', 'Dep_id'];

    public function getSubCategoriesByCategory($categoryId)
    {
        return $this->where('Category_id', $categoryId)->findAll();
    }

    public function getAllSubCategories(){
        // Joining category and department tables on Dep_id
        $builder = $this->db->table('sub_category');
        $builder->select('sub_category.*, department.Dep_fullname, category.Category_name'); // Selecting category fields and department full name
        $builder->join('department', 'department.Department_id = sub_category.Dep_id', 'left'); // Left join to get department fullname
        $builder->join('category', 'category.Category_id = sub_category.Category_id', 'left'); // Left join to get department fullname
        return $builder->get()->getResultArray(); // Execute and return results as array
    }

    public function updateSubCategory($equipmentId, $data)
    {
        return $this->update($equipmentId, $data);
    }

    public function deleteSubCategory($equipmentId)
    {
        return $this->delete($equipmentId);
    }
}
