<?= $this->extend('layouts/main'); ?>
<?= $this->section('content') ?>

<!-- Main Content -->
<div class="container-fluid content bg-white pb-1" id="content"
    style=" margin-top: 80px;box-shadow: 0px 0px 5px 5px rgba(0, 0, 0, 0.09);">
    <p class="fw-bold ps-1 pt-3 pb-3" style=" font-size: 18px; ">จัดการหมวดหลักครุภัณฑ์</p>
    <hr style="color: rgb(157, 157, 157)">
    <div class="row align-items-center mt-4">
        <!-- Add Item Button -->
        <div class="col-auto">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">เพิ่มหมวดหลัก</button>
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">เพิ่มข้อมูลหมวดหลักครุภัณฑ์</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addForm">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">รหัสหมวดหลักครุภัณฑ์</label>
                                    <input type="text" class="form-control" id="category_id" required>
                                </div>
                                <div class="mb-3">
                                    <label for="dep_id" class="col-form-label">เลือกหน่วยงาน</label>
                                    <select class="form-select" id="dep_id">
                                        <option selected disabled>กรุณาเลือกหน่วยงาน</option>
                                        <!-- Department options will be populated dynamically via AJAX -->
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="category_name" class="form-label">ชื่อหมวดหลักครุภัณฑ์</label>
                                    <input type="text" class="form-control" id="category_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="category_details" class="form-label">หมายเหตุ</label>
                                    <textarea class="form-control" id="category_details" required></textarea>
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
                                <label for="edit_category_id" class="form-label">รหัสหมวดหลักครุภัณฑ์</label>
                                <input type="text" class="form-control" id="edit_category_id" required disabled>
                            </div>
                            <div class="mb-3">
                                <label for="edit_dep_id" class="col-form-label">เลือกหน่วยงาน</label>
                                <select class="form-select" id="edit_dep_id">
                                    <option selected disabled>กรุณาเลือกหน่วยงาน</option>
                                    <!-- Department options will be populated dynamically via AJAX -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit_category_name" class="form-label">ชื่อหมวดหลักครุภัณฑ์</label>
                                <input type="text" class="form-control" id="edit_category_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_category_details" class="form-label">หมายเหตุ</label>
                                <textarea class="form-control" id="edit_category_details" required></textarea>
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

        <!-- Empty Space -->
        <div class="col-md-4"></div>

        <div class="col-auto">
            <select class="form-select" id="dep_search" aria-label="Dropdown Menu">
                <option>กรุณาเลือกหน่วยงาน</option>
            </select>
        </div>

        <!-- Search Button -->
        <div class="col-auto">
            <button class="btn btn-primary" id="search-btn" title="Search">ค้นหา</button>
        </div>
    </div>

    <div class="mt-4">
        <div id="items-table" class="table-responsive"></div> <!-- Placeholder for the dynamic table content -->
    </div>
</div>

<script>
        var userStatus = <?php echo json_encode(session()->get('Status_id')); ?>;
        var userDepId = <?php echo json_encode(session()->get('Dep_id')); ?>;
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

        $(document).ready(function () {
    let originalItems = []; // All items from server
    let filteredItems = []; // Items after filtering

    // ⬇️ Table rendering function - moved OUTSIDE ajax
    function renderTable(data) {
        let html = `
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>รหัสหมวดหลัก</th>
                        <th>ชื่อหมวดหลัก</th>
                        <th>สังกัดหน่วยงาน</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>`;

        data.forEach(item => {
            html += `
                <tr>
                    <td>${item.Category_id}</td>
                    <td>${item.Category_name}</td>
                    <td>${item.Dep_fullname || '-'}</td>
                    <td>
                        <button class="btn btn-sm btn-warning edit-btn" data-id="${item.Category_id}" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-btn" title="Delete" data-id="${item.Category_id}">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                </tr>`;
        });

        html += `</tbody></table>`;
        $('#items-table').html(html);
    }

    // Fetch categories
    $.ajax({
        url: '/spec/getAllCategories',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.error) {
                alert(response.error);
                return;
            }

            originalItems = response;

            // If user is limited to one department
            if (userStatus == 2) {
                originalItems = response.filter(item => Number(item.Dep_id) === Number(userDepId));
                $('#dep_search').val(userDepId); // Preselect their dep
            }

            filteredItems = originalItems;
            renderTable(filteredItems); // Initial render
        },
        error: function () {
            alert('Error fetching data. Please try again later.');
        }
    });

    // Fetch departments (based on user status)
    $.ajax({
        url: userStatus == 1 ? '/spec/getDepartments' : `/spec/searchdepbyId/${userDepId}`,
        method: 'GET',
        success: function (response) {
            $('#dep_search').empty().append('<option selected>กรุณาเลือกหน่วยงาน</option>');
            if (response && response.length > 0) {
                response.forEach(function (department) {
                    $('#dep_search').append(
                        `<option value="${department.Department_id}">${department.Dep_fullname}</option>`
                    );
                });
            }
        },
        error: function () {
            alert('Failed to fetch departments');
        }
    });

    // ⬇️ Search button handler
    $('#search-btn').click(function () {
        const depSearch = $('#dep_search').val();

        filteredItems = originalItems.filter(item => {
            let depMatch = depSearch !== "กรุณาเลือกหน่วยงาน" && depSearch !== "" ? item.Dep_id == depSearch : true;
            return depMatch;
        });

        renderTable(filteredItems); // Update table
    });

    // Handle form submission
    $('#saveBtn').on('click', function (e) {
        e.preventDefault();

        const data = {
            id: $('#category_id').val(),
            detail: $('#category_details').val(),
            dep_id: $('#dep_id').val(),
            name: $('#category_name').val(),
        };

        if (!data.id || !data.name || !data.dep_id) {
            alert('กรุณากรอกข้อมูลให้ครบถ้วน');
            return;
        }

        $.ajax({
            url: '/spec/saveCategory',
            method: 'POST',
            data: data,
            success: function (response) {
                alert('เพิ่มข้อมูลสำเร็จ');
                location.reload();
            },
            error: function (xhr, status, error) {
                alert('เกิดข้อผิดพลาด');
                console.log(status, error);
            }
        });
    });

    // Clear form on modal close
    $('#addModal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $('#category_id').empty().append('<option selected>กรุณาเลือกหมวดหลัก</option>');
        $('#sub_category_id').empty().append('<option selected>กรุณาเลือกหมวดย่อย</option>');
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
            $('#edit_category_id, #edit_category_name, #edit_category_details').val('');
            $('#edit_dep_id').html('<option selected disabled>Loading...</option>').prop('disabled', true);

            // Set the category ID in the modal's data attribute
            $('#editModal').data('category-id', categoryId);

            // Fetch category details using AJAX
            $.ajax({
                url: '/spec/getCategoryDetails/' + categoryId, // Adjust the endpoint
                type: 'GET',
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                    } else {
                        console.log('Fetched Data:', response); // Debugging

                        // Populate fields
                        $('#edit_category_id').val(response.Category_id);
                        $('#edit_category_name').val(response.Category_name);
                        $('#edit_category_details').val(response.Category_details);

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

                                $('#edit_dep_id').html(options).prop('disabled', false).val(response.Dep_id);
                            }
                        });

                        // Show the modal
                        $('#editModal').modal('show');
                    }
                },
                error: function() {
                    alert('Failed to fetch category details.');
                }
            });
        });

        // Save button functionality
        $(document).on('click', '#editsaveBtn', function() {
            const categoryId = $('#editModal').data('category-id'); // Get Category ID from the modal
            console.log('Saving Category ID:', categoryId); // Debugging


            if (!categoryId) {
                alert('Category ID is missing.');
                return;
            }

            const data = {
                Category_details: $('#edit_category_details').val(),
                Category_name: $('#edit_category_name').val(),
            };

            // Validate required fields
            if (!data.Category_name) {
                alert('กรุณากรอกข้อมูลให้ครบถ้วน');
                return;
            }

            // Send updated data via AJAX
            $.ajax({
                url: '/spec/updateCategory/' + categoryId, // Pass Category ID in URL
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
                    url: '/spec/deleteCategory/' + equipmentId, // URL to the delete route
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