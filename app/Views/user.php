<?= $this->extend('layouts/main'); ?>
<?= $this->section('content') ?>

<!-- Main Content -->
<div class="container-fluid content bg-white pb-1" id="content"
    style=" margin-top: 80px;box-shadow: 0px 0px 5px 5px rgba(0, 0, 0, 0.09);">
    <p class="fw-bold ps-1 pt-3 pb-3" style=" font-size: 18px; ">จัดการผู้ใช้งาน</p>
    <hr style="color: rgb(157, 157, 157)">
    <div class="row align-items-center mt-4">
        <!-- Add Item Button -->
        <div class="col-auto">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">เพิ่มผู้ใช้งาน</button>
            <!-- Add Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addModalLabel">เพิ่มข้อมูลผู้ใช้งาน</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addForm">

                                <!-- User Information -->
                                <div class="card mb-3">
                                    <div class="card-header bg-info text-white">
                                        <h6 class="mb-0">ข้อมูลผู้ใช้งาน</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">ชื่อ</label>
                                            <input type="text" class="form-control" id="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="surname" class="form-label">นามสกุล</label>
                                            <input type="text" class="form-control" id="surname" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="dep_id" class="col-form-label">หน่วยงาน</label>
                                            <select class="form-select" id="dep_id">
                                                <option selected disabled>กรุณาเลือกหน่วยงาน</option>
                                                <!-- Department options will be populated dynamically via AJAX -->
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status_id" class="col-form-label">สถานะ</label>
                                            <select class="form-select" id="status_id">
                                                <!-- Options will be populated dynamically via AJAX -->
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Login Information -->
                                <div class="card mb-3">
                                    <div class="card-header bg-secondary text-white">
                                        <h6 class="mb-0">ข้อมูลการเข้าสู่ระบบ</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">ชื่อผู้ใช้</label>
                                            <input type="text" class="form-control" id="username" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">รหัสผ่าน</label>
                                            <input type="password" class="form-control" id="password" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="cfpassword" class="form-label">ยืนยันรหัสผ่าน</label>
                                            <input type="password" class="form-control" id="cfpassword" required>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="saveBtn">บันทึก</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูลผู้ใช้งาน</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">

                            <!-- User Information -->
                            <div class="card mb-3">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0">ข้อมูลผู้ใช้งาน</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="edit_name" class="form-label">ชื่อ</label>
                                        <input type="text" class="form-control" id="edit_name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_surname" class="form-label">นามสกุล</label>
                                        <input type="text" class="form-control" id="edit_surname" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_dep_id" class="col-form-label">หน่วยงาน</label>
                                        <select class="form-select" id="edit_dep_id" required>
                                            <option selected disabled>กรุณาเลือกหน่วยงาน</option>
                                            <!-- Dynamic options -->
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_status_id" class="col-form-label">สถานะ</label>
                                        <select class="form-select" id="edit_status_id" required>
                                            <!-- Dynamic options -->
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Login Information -->
                            <div class="card mb-3">
                                <div class="card-header bg-secondary text-white">
                                    <h6 class="mb-0">ข้อมูลการเข้าสู่ระบบ</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="edit_username" class="form-label">ชื่อผู้ใช้</label>
                                        <input type="text" class="form-control" id="edit_username" required>
                                    </div>
                                    <div class="mb-3 position-relative">
                                        <label for="edit_password" class="form-label">รหัสผ่าน</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="edit_password" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 position-relative">
                                        <label for="edit_cfpassword" class="form-label">ยืนยันรหัสผ่าน</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="edit_cfpassword" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning" id="editsaveBtn">
                            <i class="fa fa-save"></i> บันทึกข้อมูล
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i> ยกเลิก
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Empty Space -->
        <div class="col-md-4"></div>

    <div class="mt-4">
        <div id="items-table" class="table-responsive"></div> <!-- Placeholder for the dynamic table content -->
    </div>
</div>

<script>
    $(document).ready(function() {
        // Fetch departments via AJAX when the page loads
        $.ajax({
            url: '/spec/getDepartments', // URL to the new controller method
            method: 'GET',
            success: function(response) {
                // Check if the response contains data
                if (response && response.length > 0) {
                    // Loop through the departments and append them to the dropdown
                    response.forEach(function(department) {
                        $('#dep_id').append(
                            `<option value="${department.Department_id}">${department.Dep_fullname}</option>`
                        );
                    });
                }
            },
            error: function() {
                alert('Failed to fetch departments');
            }
        });

        $.ajax({
            url: '/spec/getStatus', // URL to the new controller method
            method: 'GET',
            success: function(response) {
                // Check if the response contains data
                if (response && response.length > 0) {
                    // Loop through the departments and append them to the dropdown
                    response.forEach(function(status) {
                        $('#status_id').append(
                            `<option value="${status.Status_id}">${status.Status_name}</option>`
                        );
                    });
                }
            },
            error: function() {
                alert('Failed to fetch departments');
            }
        });

        $(document).ready(function() {
            // Fetch all items and generate the table dynamically
            $.ajax({
                url: '/spec/getAllUsers',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                        return;
                    }

                    // Generate the table HTML dynamically
                    let html = `
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>username</th>
                    <th>ชื่อ - นามสกุล</th>
                    <th>หน่วยงาน</th>
                    <th>สถานะ</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
    `;

                    // Iterate over the response to populate table rows
                    response.forEach(item => {
                        html += `
            <tr>
                <td>${item.Username}</td>
                <td>${item.Name}</td>
                <td>${item.Dep_fullname || '-'}</td>
                <td>${item.Status_name || '-'}</td>
                <td>
                    <button class="btn btn-sm btn-warning edit-btn" data-id="${item.User_id}" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal">
                        <i class="bi bi-pencil-fill"></i>
                    </button>
                    <button class="btn btn-sm btn-danger delete-btn" title="Delete" data-id="${item.User_id}">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </td>
            </tr>
        `;
                    });

                    html += '</tbody></table>';

                    // Append the table to the placeholder container
                    $('#items-table').html(html);
                },

                error: function() {
                    alert('Error fetching data. Please try again later.');
                }
            });

            // Handle form submission
            $('#saveBtn').on('click', function(e) {
                e.preventDefault();
                let password = $('#password').val();
                let confirmPassword = $('#cfpassword').val();

                if (password !== confirmPassword) {
                    alert('ยืนยันรหัสผ่านไม่ถูกต้อง');
                    return; // Stop execution if passwords don't match
                }

                const data = {
                    name: $('#name').val(),
                    surname: $('#surname').val(),
                    dep_id: $('#dep_id').val(),
                    status_id: $('#status_id').val(),
                    username: $('#username').val(),
                    password: password, // Use the password variable
                };

                console.log(data); // Check if data is populated correctly

                if (!data.name || !data.dep_id || !data.status_id || !data.username || !data.password) {
                    alert('กรุณากรอกข้อมูลให้ครบถ้วน');
                    return;
                }

                // Change content type and data format
                $.ajax({
                    url: '/spec/saveUser',
                    method: 'POST',
                    data: data, // Send data as a normal object
                    success: function(response) {
                        alert('เพิ่มข้อมูลสำเร็จ');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('เกิดข้อผิดพลาด');
                        console.log(status, error);
                    }
                });
            });

            // Clear form on modal close
            $('#addModal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });
        });

        //edit
        $(document).on('click', '.edit-btn', function() {
            const categoryId = $(this).data('id'); // Get Category ID from the button
            console.log('Category ID:', categoryId); // Debugging

            if (!categoryId) {
                alert('Category ID is missing or invalid.');
                return;
            }

            // Set the category ID in the modal's data attribute
            $('#editModal').data('category-id', categoryId);

            // Fetch user details
            $.ajax({
                url: '/spec/getUserDetails/' + categoryId,
                type: 'GET',
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                    } else {
                        console.log('Fetched Data:', response); // Debugging

                        // Populate fields
                        $('#edit_username').val(response.Username);
                        $('#edit_name').val(response.Name);
                        $('#edit_surname').val(response.Surname);

                        // Fetch and populate departments
                        $.ajax({
                            url: '/spec/getDepartments',
                            method: 'GET',
                            dataType: 'json',
                            success: function(departments) {
                                let options = '<option selected disabled>กรุณาเลือกหน่วยงาน</option>';
                                $.each(departments, function(index, department) {
                                    options += `<option value="${department.Department_id}">${department.Dep_fullname}</option>`;
                                });

                                // Update department dropdown and select the correct value
                                $('#edit_dep_id').html(options).val(response.Dep_id);
                            },
                            error: function() {
                                alert('Failed to fetch departments.');
                            }
                        });

                        // Fetch and populate status
                        $.ajax({
                            url: '/spec/getStatus',
                            method: 'GET',
                            success: function(statuses) {
                                let statusOptions = '<option selected disabled>กรุณาเลือกสถานะ</option>';
                                $.each(statuses, function(index, status) {
                                    statusOptions += `<option value="${status.Status_id}">${status.Status_name}</option>`;
                                });

                                // Update status dropdown and select the correct value
                                $('#edit_status_id').html(statusOptions).val(response.Status_id);
                            },
                            error: function() {
                                alert('Failed to fetch status.');
                            }
                        });

                        // Show the modal after data has been loaded
                        $('#editModal').modal('show');
                    }
                },
                error: function() {
                    alert('Failed to fetch user details.');
                }
            });
        });

        // Save button functionality
        $(document).on('click', '#editsaveBtn', function() {
            const categoryId = $('#editModal').data('category-id'); // Get Category ID from the modal
            console.log('Saving ID:', categoryId); // Debugging
            let password = $('#edit_password').val();
            let confirmPassword = $('#edit_cfpassword').val();

            if (!categoryId) {
                alert('ID is missing.');
                return;
            }

            if (password !== confirmPassword) {
                    alert('ยืนยันรหัสผ่านไม่ถูกต้อง');
                    return; // Stop execution if passwords don't match
                }

            const data = {
                    Name: $('#edit_name').val(),
                    Surname: $('#edit_surname').val(),
                    Dep_id: $('#edit_dep_id').val(),
                    Status_id: $('#edit_status_id').val(),
                    Username: $('#edit_username').val(),
                    Password: password, // Use the password variable
                };

            // Validate required fields
            if (!data.Name || !data.Surname || !data.Dep_id || !data.Status_id || !data.Username || !data.Password) {
                alert('กรุณากรอกข้อมูลให้ครบถ้วน');
                return;
            }

            // Send updated data via AJAX
            $.ajax({
                url: '/spec/updateUser/' + categoryId, // Pass Category ID in URL
                method: 'POST',
                data: data,
                success: function(response) {
                    if (response.success) {
                        alert('ข้อมูลถูกอัปเดตเรียบร้อย');
                        $('#editModal').modal('hide'); // Close modal on success
                        location.reload(); // Reload or update the data table
                    } else {
                        alert(response.error || 'เกิดข้อผิดพลาดในการบันทึกข้อมูล');
                    }
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการติดต่อกับเซิร์ฟเวอร์');
                }
            });
        });


        $(document).on('click', '.delete-btn', function() {
            const equipmentId = $(this).data('id'); // Get the Equipment ID from the button

            // Confirm before deleting
            if (confirm('Are you sure you want to delete this item?')) {
                // Send the DELETE request to the server
                $.ajax({
                    url: '/spec/deleteUser/' + equipmentId, // URL to the delete route
                    type: 'DELETE',
                    success: function(response) {
                        if (response.success) {
                            alert('Item deleted successfully.');
                            location.reload(); // Optionally reload the page
                        } else {
                            alert('Failed to delete the item.');
                        }
                    },
                    error: function() {
                        alert('Error deleting the item. Please try again.');
                    }
                });
            }
        });

    });
</script>

<?= $this->endSection() ?>