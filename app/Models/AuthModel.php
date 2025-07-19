<?php

namespace App\Models;
use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'User_id';
    protected $allowedFields = [
        'User_id',
        'Username',
        'Name',
        'Surname',
        'Dep_id',
        'Status_id',
        'Password'
    ];

    public function CheckLogin($username, $password)
{
    $builder = $this->db->table('users');
    $builder->select('users.*, users.User_id, users.Username, users.Dep_id, department.Dep_fullname');
    $builder->join('department', 'department.Department_id = users.Dep_id');
    $builder->where('users.Username', $username);
    $builder->where('users.Password', $password);
    $query = $builder->get();

    return $query->getRowArray();  // Return the result as an array
}


    public function getUserinfo()
    {
        $builder = $this->db->table('users');
        $builder->select('users.*, department.Dep_fullname, status.Status_name'); 
        $builder->join('department', 'department.Department_id = users.Dep_id', 'left'); 
        $builder->join('status', 'status.Status_id = users.Status_id', 'left'); 
        return $builder->get()->getResultArray(); // Execute and return results as array
    }

    public function getUser($depId)
    {
        return $this->where('Department_id', $depId)->findAll();
    }

    public function updateUser($equipmentId, $data)
    {
        return $this->update($equipmentId, $data);
    }

    public function deleteUser($equipmentId)
    {
        return $this->delete($equipmentId);
    }
}