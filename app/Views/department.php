<?= $this->extend('layouts/main'); ?>
<?= $this->section('content') ?>

<!-- Main Content -->
<div class="container-fluid content bg-white pb-1" id="content"
    style=" margin-top: 80px;box-shadow: 0px 0px 5px 5px rgba(0, 0, 0, 0.09);">
    <p class="fw-bold ps-1 pt-3 pb-3" style=" font-size: 18px; ">จัดการหน่วยงาน</p>
    <hr style="color: rgb(157, 157, 157)">
    <div class="row align-items-center mt-4">
        <!-- Add Item Button -->
        <div class="col-auto">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">เพิ่มหน่วยงาน</button>
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">เพิ่มข้อมูลหน่วยงาน</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addForm">
                                <div class="mb-3">
                                    <label for="id" class="form-label">รหัสหน่วยงาน</label>
                                    <input type="text" class="form-control" id="id" required>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">ชื่อย่อหน่วยงาน</label>
                                    <input type="text" class="form-control" id="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">ชื่อเต็มหน่วยงาน</label>
                                    <input type="text" class="form-control" id="fullname" required>
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูลครุภัณฑ์</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">
                            <div class="mb-3">
                                <label for="edit_id" class="form-label">รหัสหน่วยงาน</label>
                                <input type="text" class="form-control" id="edit_id" required disabled>
                            </div>
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">ชื่อย่อหน่วยงาน</label>
                                <input type="text" class="form-control" id="edit_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_fullname" class="form-label">ชื่อเต็มหน่วยงาน</label>
                                <input type="text" class="form-control" id="edit_fullname" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="editsaveBtn">บันทึก</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>
        </div>

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

        $(document).ready(function() {
            // Fetch all items and generate the table dynamically
            $.ajax({
                url: '/spec/getDepartments',
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
                    <th>รหัสหน่วยงาน</th>
                    <th>ชื่อย่อหน่วยงาน</th>
                    <th>ชื่อเต็มของหน่วยงาน</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
    `;

                    // Iterate over the response to populate table rows
                    response.forEach(item => {
                        html += `
            <tr>
                <td>${item.Department_id}</td>
                <td>${item.Dep_name}</td>
                <td>${item.Dep_fullname || '-'}</td>
                <td>
                    <button class="btn btn-sm btn-warning edit-btn" data-id="${item.Department_id}" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal">
                        <i class="bi bi-pencil-fill"></i>
                    </button>
                    <button class="btn btn-sm btn-danger delete-btn" title="Delete" data-id="${item.Department_id}">
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

                const data = {
                    id: $('#id').val(),
                    fullname: $('#fullname').val(),
                    name: $('#name').val(),
                };

                console.log(data); // Check if data is populated correctly

                if (!data.id || !data.name || !data.fullname) {
                    alert('กรุณากรอกข้อมูลให้ครบถ้วน');
                    return;
                }

                // Change content type and data format
                $.ajax({
                    url: '/spec/saveDepartment',
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

                    // Clear modal fields before opening
                    $('#edit_id, #edit_name, #edit_fullname').val('');

                    // Set the category ID in the modal's data attribute
                    $('#editModal').data('category-id', categoryId);

                    // Fetch category details using AJAX
                    $.ajax({
                        url: '/spec/getDepartmentDetails/' + categoryId, // Adjust the endpoint
                        type: 'GET',
                        success: function(response) {
                            if (response.error) {
                                alert(response.error);
                            } else {
                                console.log('Fetched Data:', response); // Debugging

                                // Populate fields
                                $('#edit_id').val(response.Department_id);
                                $('#edit_name').val(response.Dep_name);
                                $('#edit_fullname').val(response.Dep_fullname);

                                // Show the modal
                                $('#editModal').modal('show');
                            }
                        },
                        error: function() {
                            alert('Failed to fetch category details.');
                        }
                    });
                });

}
    );
    

    // Save button functionality
    $(document).on('click', '#editsaveBtn', function() {
                    const categoryId = $('#editModal').data('category-id'); // Get Category ID from the modal
                    console.log('Saving ID:', categoryId); // Debugging

                    if (!categoryId) {
                        alert('Category ID is missing.');
                        return;
                    }

                    const data = {
                        Department_id: $('#edit_id').val(),
                        Dep_fullname: $('#edit_fullname').val(),
                        Dep_name: $('#edit_name').val(),
                    };

                    // Validate required fields
                    if (!data.Department_id || !data.Dep_fullname || !data.Dep_name) {
                        alert('กรุณากรอกข้อมูลให้ครบถ้วน');
                        return;
                    }

                    // Send updated data via AJAX
                    $.ajax({
                        url: '/spec/updateDepartment/' + categoryId, // Pass Category ID in URL
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
                url: '/spec/deleteDepartment/' + equipmentId, // URL to the delete route
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
</script>

<?= $this->endSection() ?>