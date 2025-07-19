<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ItemsModel;
use App\Models\AuthModel;

class Spec extends BaseController
{
    public function index()
    {
        // Instantiate the Category model
        $categoryModel = new CategoryModel();

        // Get categories with department full names
        $posts = $categoryModel->getCategoriesWithDepartmentFullname();  // Correct method name
        $data = [
            'posts' => $posts, // Pass the list of posts to the view
        ];

        return view('spec', $data);
    }

    public function fetchItems($id)
    {
        if ($this->request->isAJAX()) {
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT); // Validate input

            // Fetch items based on the category (CardId)
            $model = new ItemsModel();
            $data = $model->getItemsByCategory($id);

            if (empty($data)) {
                return $this->response->setJSON(['error' => 'No data found for this category.']);
            }

            return $this->response->setJSON($data);
        }

        throw new \CodeIgniter\Exceptions\PageNotFoundException('Page not found');
    }

    public function fetchAllItems()
    {
        // Initialize the EquipmentModel
        $model = new \App\Models\EquipmentModel();

        // Fetch all items
        $data = $model->getEquipment();  // Make sure Equipment_id is present here

        // Return the data as JSON
        return $this->response->setJSON($data);
    }

    public function searchItemsbydepandcat()
    {
        $model = new ItemsModel();

        // Get department and category from the request
        $depId = $this->request->getVar('depId');
        $catId = $this->request->getVar('catId');

        // Fetch filtered items
        $items = $model->fetchItemsByDepAndCat($depId, $catId);

        return $this->response->setJSON($items);
    }

    public function searchItems()
    {
        $searchTerm = $this->request->getPost('searchTerm');
        $searchTerm = filter_var($searchTerm, FILTER_SANITIZE_STRING);

        if (empty($searchTerm)) {
            return $this->response->setJSON(['error' => 'Search term is required.']);
        }

        $itemsModel = new ItemsModel();
        $results = $itemsModel->searchItems($searchTerm);

        return $this->response->setJSON($results);
    }

    public function Authen()
    {
        // If the user is already logged in, redirect them to the admin page
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/spec/admin');
        }

        // If not logged in, show the login page
        return view('Login');
    }


    public function authenticate()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $authModel = new AuthModel();
        $user = $authModel->CheckLogin($username, $password);

        if ($user) {
            session()->set([
                'User_id'      => $user['User_id'],
                'Username'     => $user['Username'],
                'Dep_id'       => $user['Dep_id'],
                'Dep_fullname' => $user['Dep_fullname'],
                'Status_id'    => $user['Status_id'],  // Store user role
                'isLoggedIn'   => true,
            ]);

            session()->regenerate(true);
            return redirect()->to('/spec/admin');
        } else {
            return redirect()->back()->with('error', 'Invalid username or password.');
        }
    }

    public function logout()
    {
        session()->destroy(); // Destroy the session
        return redirect()->to('/spec')->with('success', 'You have been logged out.');
    }

    public function Admin()
    {
        // Check if the user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/spec')->with('error', 'You must be logged in to access this page.');
        }

        $active = $this->request->getGet('active');

        if ($active === 'typeSpec') {
            $data['activePage'] = 'typeSpec';
            return view('typeSpec', $data);
        }
        if ($active === 'SubtypeSpec') {
            $data['activePage'] = 'SubtypeSpec';
            return view('subtype', $data);
        }
        if ($active === 'Department') {
            $data['activePage'] = 'Department';
            return view('department', $data);
        }
        if ($active === 'User') {
            $data['activePage'] = 'User';
            return view('user', $data);
        }
        if ($active === 'Report') {
            $data['activePage'] = 'Report';
            return view('report', $data);
        }

        return view('admin');
    }

    public function saveEquipment()
    {
        $model = new \App\Models\EquipmentModel();

        // Get form data
        $data = $this->request->getPost();

        // Handle file upload
        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = preg_replace('/[^\w\-\.]/', '_', $file->getName()); // Replaces special characters with "_"
            $path = 'uploads/equipment/';

            if (file_exists($path . $fileName)) {
                $fileName = $file->getRandomName(); // Use random name if duplicate
            }

            $file->move($path, $fileName);

            $data['File_path_pdf'] = 'uploads/equipment/' . $fileName; // Save the correct path
        } else {
            $data['File_path_pdf'] = null; // In case no file was uploaded
        }

        // Save to database
        $model->insert([
            'Equipment_code' => $data['code'],
            'Equipment_details' => $data['detail'],
            'Price' => $data['price'],
            'Dep_id' => $data['dep_id'],
            'Category_id' => $data['category_id'],
            'Sub_category_id' => $data['sub_category_id'],
            'File_path_pdf' => $data['File_path_pdf'], // Make sure the file path is correctly saved
            'Equipment_status' => '1',
            'Created_date' => date('Y-m-d H:i:s'),
            'Update_date' => date('Y-m-d H:i:s')
        ]);

        return $this->response->setJSON(['status' => 'success']);
    }

    public function download($filename)
    {
        $model = new \App\Models\EquipmentModel();
        $filename = urldecode($filename); // Decode special characters
        $equipment = $model->where('File_path_pdf', 'uploads/equipment/' . $filename)->first();

        if (!$equipment || !file_exists(FCPATH . $equipment['File_path_pdf'])) {
            return $this->response->setJSON(['error' => 'File not found or invalid file path'])->setStatusCode(404);
        }

        return $this->response->download(FCPATH . $equipment['File_path_pdf'], null);
    }

    public function saveCategory()
    {
        if ($this->request->isAJAX()) {
            $categoryModel = new \App\Models\CategoryModel();

            // Get the form data
            $data = $this->request->getPost();

            // Prepare the data array to insert
            $categoryData = [
                'Category_id' => $data['id'], // New field for the unique code
                'Category_details' => $data['detail'],
                'Dep_id' => $data['dep_id'],
                'Category_name' => $data['name'],
                'Icon_path' => [''],
                'Category_color' => ['#4caf50']
            ];

            try {
                $categoryModel->insert($categoryData);

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Equipment added successfully.',
                    'Category_id' => $categoryModel->getInsertID(), // Get the auto-increment ID
                ]);
            } catch (\Exception $e) {
                return $this->response->setJSON(['error' => $e->getMessage()]);
            }
        }
    }

    public function saveSubCategory()
    {
        if ($this->request->isAJAX()) {
            $subcategoryModel = new \App\Models\SubCategoryModel();

            // Get the form data
            $data = $this->request->getPost();

            // Prepare the data array to insert
            $subcategoryData = [
                'Category_id' => $data['category_id'],
                'Dep_id' => $data['dep_id'],
                'Sub_category_name' => $data['name'],
            ];

            try {
                $subcategoryModel->insert($subcategoryData);

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Equipment added successfully.',
                    'Sub_category_id' => $subcategoryModel->getInsertID(), // Get the auto-increment ID
                ]);
            } catch (\Exception $e) {
                return $this->response->setJSON(['error' => $e->getMessage()]);
            }
        }
    }

    public function saveDepartment()
    {
        if ($this->request->isAJAX()) {
            $departmentModel = new \App\Models\DepartmentModel();

            // Get the form data
            $data = $this->request->getPost();

            // Prepare the data array to insert
            $departmentData = [
                'Department_id' => $data['id'],
                'Dep_name' => $data['name'],
                'Dep_fullname' => $data['fullname'],
            ];

            $departmentModel->insert($departmentData);
        }
    }

    public function saveUser()
    {
        if ($this->request->isAJAX()) {
            $userModel = new \App\Models\AuthModel();

            // Get the form data
            $data = $this->request->getPost();

            // Prepare the data array to insert
            $userData = [
                'Username' => $data['username'],
                'Name' => $data['name'],
                'Surname' => $data['surname'],
                'Dep_id' => $data['dep_id'],
                'Status_id' => $data['status_id'],
                'Password' => $data['password'],
            ];

            $userModel->insert($userData);
        }
    }

    public function fetchEquipment()
    {
        $equipmentModel = new \App\Models\EquipmentModel();
        $equipmentList = $equipmentModel->getEquipment();

        return $this->response->setJSON($equipmentList);
    }

    public function getDepartments()
    {
        if ($this->request->isAJAX()) {
            // Instantiate Department model
            $departmentModel = new \App\Models\DepartmentModel();

            // Fetch all departments
            $departments = $departmentModel->findAll();

            // Return the departments as JSON
            return $this->response->setJSON($departments);
        }

        // If not an AJAX request, throw a 404 error
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Page not found');
    }

    public function getAllCategories()
    {
        // Fetch categories with department full names
        $categoryModel = new \App\Models\CategoryModel();
        $categories = $categoryModel->getCategoriesWithDepartmentFullname();

        return $this->response->setJSON($categories);
    }

    public function getAllSubCategories()
    {
        // Fetch categories with department full names
        $subcategoryModel = new \App\Models\SubCategoryModel();
        $subcategories = $subcategoryModel->getAllSubCategories();

        return $this->response->setJSON($subcategories);
    }

    public function getAllUsers()
    {
        if ($this->request->isAJAX()) {
            // Instantiate Department model
            $userModel = new \App\Models\AuthModel();

            // Fetch all departments
            $users = $userModel->getUserinfo();

            // Return the departments as JSON
            return $this->response->setJSON($users);
        }

        // If not an AJAX request, throw a 404 error
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Page not found');
    }

    public function getStatus()
    {
        if ($this->request->isAJAX()) {
            // Instantiate Department model
            $statusModel = new \App\Models\StatusModel();

            // Fetch all departments
            $status = $statusModel->findAll();

            // Return the departments as JSON
            return $this->response->setJSON($status);
        }

        // If not an AJAX request, throw a 404 error
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Page not found');
    }

    public function getCategories($depId)
    {
        if ($this->request->isAJAX()) {
            $depId = filter_var($depId, FILTER_SANITIZE_NUMBER_INT);

            // Fetch categories by department ID
            $categoryModel = new \App\Models\CategoryModel();
            $categories = $categoryModel->where('Dep_id', $depId)->findAll();

            // If no categories found, return error
            if (empty($categories)) {
                return $this->response->setJSON(['error' => 'No categories found for this department.']);
            }

            return $this->response->setJSON($categories);
        }

        throw new \CodeIgniter\Exceptions\PageNotFoundException('Page not found');
    }

    public function getSubCategories($categoryId)
    {
        if ($this->request->isAJAX()) {
            $categoryId = filter_var($categoryId, FILTER_SANITIZE_NUMBER_INT);

            // Fetch subcategories by category ID
            $subCategoryModel = new \App\Models\SubCategoryModel();
            $subCategories = $subCategoryModel->where('Category_id', $categoryId)->findAll();

            // If no subcategories found, return error
            if (empty($subCategories)) {
                return $this->response->setJSON(['error' => 'No sub-categories found for this category.']);
            }

            return $this->response->setJSON($subCategories);
        }

        throw new \CodeIgniter\Exceptions\PageNotFoundException('Page not found');
    }

    public function updateEquipmentStatus()
    {
        $equipmentId = $this->request->getPost('Equipment_id');
        $equipmentStatus = $this->request->getPost('Equipment_status');

        // Debug
        // log_message('info', "Received Equipment ID: {$equipmentId}, Status: {$equipmentStatus}");

        $model = new ItemsModel();

        $updated = $model->updateStatus($equipmentId, ['Equipment_status' => $equipmentStatus]);

        if ($updated) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function getEquipmentDetails($equipmentId)
    {
        // Sanitize the input to ensure it's a valid number
        $equipmentId = filter_var($equipmentId, FILTER_SANITIZE_NUMBER_INT);

        if (!$equipmentId) {
            return $this->response->setJSON(['error' => 'Invalid equipment ID.']);
        }

        // Fetch the equipment details from the database
        $equipmentModel = new \App\Models\EquipmentModel();
        $equipmentData = $equipmentModel->find($equipmentId);

        log_message('info', "Fetched Equipment Data: " . json_encode($equipmentData)); // Log fetched data

        if ($equipmentData) {
            // Return the equipment details as JSON for the frontend
            return $this->response->setJSON($equipmentData);
        } else {
            return $this->response->setJSON(['error' => 'Equipment not found.']);
        }
    }

    public function getCategoryDetails($equipmentId)
    {
        // Sanitize the input to ensure it's a valid number
        $equipmentId = filter_var($equipmentId, FILTER_SANITIZE_NUMBER_INT);

        if (!$equipmentId) {
            return $this->response->setJSON(['error' => 'Invalid equipment ID.']);
        }

        // Fetch the equipment details from the database
        $categoryModel = new \App\Models\CategoryModel();
        $categoryData = $categoryModel->find($equipmentId);

        log_message('info', "Fetched Equipment Data: " . json_encode($categoryData)); // Log fetched data

        if ($categoryData) {
            // Return the equipment details as JSON for the frontend
            return $this->response->setJSON($categoryData);
        } else {
            return $this->response->setJSON(['error' => 'Equipment not found.']);
        }
    }

    public function getSubCategoryDetails($equipmentId)
    {
        // Sanitize the input to ensure it's a valid number
        $equipmentId = filter_var($equipmentId, FILTER_SANITIZE_NUMBER_INT);

        if (!$equipmentId) {
            return $this->response->setJSON(['error' => 'Invalid equipment ID.']);
        }

        // Fetch the equipment details from the database
        $subcategoryModel = new \App\Models\SubCategoryModel();
        $subcategoryData = $subcategoryModel->find($equipmentId);

        log_message('info', "Fetched Data: " . json_encode($subcategoryData)); // Log fetched data

        if ($subcategoryData) {
            // Return the equipment details as JSON for the frontend
            return $this->response->setJSON($subcategoryData);
        } else {
            return $this->response->setJSON(['error' => 'Equipment not found.']);
        }
    }

    public function getDepartmentDetails($equipmentId)
    {
        // Sanitize the input to ensure it's a valid number
        $equipmentId = filter_var($equipmentId, FILTER_SANITIZE_NUMBER_INT);

        if (!$equipmentId) {
            return $this->response->setJSON(['error' => 'Invalid equipment ID.']);
        }

        // Fetch the equipment details from the database
        $departmentModel = new \App\Models\DepartmentModel();
        $departmentData = $departmentModel->find($equipmentId);

        log_message('info', "Fetched Data: " . json_encode($departmentData)); // Log fetched data

        if ($departmentData) {
            // Return the equipment details as JSON for the frontend
            return $this->response->setJSON($departmentData);
        } else {
            return $this->response->setJSON(['error' => 'Equipment not found.']);
        }
    }

    public function searchdepbyId($userDepId)
    {
        $departmentModel = new \App\Models\DepartmentModel();
        $departmentData = $departmentModel->getDepartment($userDepId);

        if ($departmentData) {
            // Return the equipment details as JSON for the frontend
            return $this->response->setJSON($departmentData);
        } else {
            return $this->response->setJSON(['error' => 'Equipment not found.']);
        }
    }

    public function getUserDetails($equipmentId)
    {
        // Sanitize the input to ensure it's a valid number
        $equipmentId = filter_var($equipmentId, FILTER_SANITIZE_NUMBER_INT);

        if (!$equipmentId) {
            return $this->response->setJSON(['error' => 'Invalid ID.']);
        }

        // Fetch the equipment details from the database
        $userModel = new \App\Models\AuthModel();
        $userData = $userModel->find($equipmentId);

        log_message('info', "Fetched Data: " . json_encode($userData)); // Log fetched data

        if ($userData) {
            // Return the equipment details as JSON for the frontend
            return $this->response->setJSON($userData);
        } else {
            return $this->response->setJSON(['error' => 'Equipment not found.']);
        }
    }

    public function updateEquipment($equipmentId)
    {
        if ($this->request->isAJAX()) {
            $data = $this->request->getPost();

            // Basic validation example
            if (empty($data['Equipment_code']) || empty($data['Equipment_details'])) {
                return $this->response->setJSON(['error' => 'Required fields are missing.']);
            }

            $data['Update_date'] = date('Y-m-d'); // Update timestamp

            $equipmentModel = new \App\Models\EquipmentModel();
            $updated = $equipmentModel->updateEquipment($equipmentId, $data);

            if ($updated) {
                return $this->response->setJSON(['success' => true, 'message' => 'Equipment updated successfully.']);
            } else {
                return $this->response->setJSON(['error' => 'Failed to update equipment.']);
            }
        }

        throw new \CodeIgniter\Exceptions\PageNotFoundException('Invalid Request');
    }

    public function updateCategory($equipmentId)
    {
        if ($this->request->isAJAX()) {
            $data = $this->request->getPost();
            log_message('debug', 'Received Data: ' . json_encode($data));
            // Basic validation example
            if (empty($data['Category_details']) || empty($data['Category_name'])) {
                return $this->response->setJSON(['error' => 'Required fields are missing.']);
            }
            $categoryModel = new \App\Models\CategoryModel();
            $updated = $categoryModel->updateCategory($equipmentId, $data);

            log_message('debug', 'Update Status: ' . ($updated ? 'Success' : 'Failed'));

            if ($updated) {
                return $this->response->setJSON(['success' => true, 'message' => 'Equipment updated successfully.']);
            } else {
                return $this->response->setJSON(['error' => 'Failed to update equipment.']);
            }
        }
    }

    public function updateSubCategory($equipmentId)
    {
        if ($this->request->isAJAX()) {
            $data = $this->request->getPost();
            // Basic validation example
            if (empty($data['Sub_category_name'])) {
                return $this->response->setJSON(['error' => 'Required fields are missing.']);
            }
            $subcategoryModel = new \App\Models\SubCategoryModel();
            $updated = $subcategoryModel->updateSubCategory($equipmentId, $data);

            if ($updated) {
                return $this->response->setJSON(['success' => true, 'message' => 'Updated successfully.']);
            } else {
                return $this->response->setJSON(['error' => 'Failed to update.']);
            }
        }
    }

    public function updateDepartment($equipmentId)
    {
        if ($this->request->isAJAX()) {
            $data = $this->request->getPost();
            // Basic validation example
            if (empty($data['Department_id']) || empty($data['Dep_name']) || empty($data['Dep_fullname'])) {
                return $this->response->setJSON(['error' => 'Required fields are missing.']);
            }
            $departmentModel = new \App\Models\DepartmentModel();
            $updated = $departmentModel->updateDepartment($equipmentId, $data);

            if ($updated) {
                return $this->response->setJSON(['success' => true, 'message' => 'Updated successfully.']);
            } else {
                return $this->response->setJSON(['error' => 'Failed to update.']);
            }
        }
    }

    public function updateUser($equipmentId)
    {
        if ($this->request->isAJAX()) {
            $data = $this->request->getPost();
            // Basic validation example
            if (empty($data['Username']) || empty($data['Name']) || empty($data['Dep_id']) || empty($data['Status_id']) || empty($data['Password'])) {
                return $this->response->setJSON(['error' => 'Required fields are missing.']);
            }
            $userModel = new \App\Models\AuthModel();
            $updated = $userModel->updateUser($equipmentId, $data);

            if ($updated) {
                return $this->response->setJSON(['success' => true, 'message' => 'Updated successfully.']);
            } else {
                return $this->response->setJSON(['error' => 'Failed to update.']);
            }
        }
    }

    // Method to delete equipment by ID
    public function deleteEquipment($equipmentId)
    {
        $model = new \App\Models\EquipmentModel();

        // Attempt to delete the record
        $deleted = $model->delete($equipmentId);

        if ($deleted) {
            return $this->response->setJSON(['success' => true, 'message' => 'Equipment deleted successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete equipment.']);
        }
    }

    public function deleteCategory($equipmentId)
    {
        $model = new \App\Models\CategoryModel();

        // Attempt to delete the record
        $deleted = $model->deleteCategory($equipmentId);

        if ($deleted) {
            return $this->response->setJSON(['success' => true, 'message' => 'Category deleted successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete category.']);
        }
    }

    public function deleteSubCategory($equipmentId)
    {
        $model = new \App\Models\SubCategoryModel();

        // Attempt to delete the record
        $deleted = $model->deleteSubCategory($equipmentId);

        if ($deleted) {
            return $this->response->setJSON(['success' => true, 'message' => 'Category deleted successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete category.']);
        }
    }

    public function deleteDepartment($equipmentId)
    {
        $model = new \App\Models\DepartmentModel();

        // Attempt to delete the record
        $deleted = $model->deleteDepartment($equipmentId);

        if ($deleted) {
            return $this->response->setJSON(['success' => true, 'message' => 'Category deleted successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete category.']);
        }
    }

    public function deleteUser($equipmentId)
    {
        $model = new \App\Models\AuthModel();

        // Attempt to delete the record
        $deleted = $model->deleteUser($equipmentId);

        if ($deleted) {
            return $this->response->setJSON(['success' => true, 'message' => 'Category deleted successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete category.']);
        }
    }
}