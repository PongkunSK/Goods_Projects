<?= $this->extend('layouts/main'); ?>
<?= $this->section('content') ?>

<!-- Main Content -->
<div class="container-fluid content bg-white pb-1" id="content"
    style=" margin-top: 80px;box-shadow: 0px 0px 5px 5px rgba(0, 0, 0, 0.09);">
    <p class="fw-bold ps-1 pt-3 pb-3" style=" font-size: 18px; ">จัดการหมวดย่อยครุภัณฑ์</p>
    <hr style="color: rgb(157, 157, 157)">
    <div class="row align-items-center mt-4">
        <!-- Add Item Button -->
        <div class="col-auto">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">เพิ่มหมวดย่อยครุภัณฑ์</button>
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">เพิ่มข้อมูลหมวดย่อยครุภัณฑ์</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addForm">

                                <div class="mb-3">
                                    <label for="dep_id" class="col-form-label">เลือกหน่วยงาน</label>
                                    <select class="form-select" id="dep_id">
                                        <option selected disabled>กรุณาเลือกหน่วยงาน</option>
                                        <!-- Department options will be populated dynamically via AJAX -->
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="category_id" class="col-form-label">เลือกหมวดหลักครุภัณฑ์</label>
                                    <select class="form-select" id="category_id" disabled>
                                        <option selected disabled>กรุณาเลือกหมวดหลักครุภัณฑ์</option>
                                        <!-- Options will be populated dynamically -->
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label">ชื่อหมวดย่อยครุภัณฑ์</label>
                                    <input type="text" class="form-control" id="name" required>
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
                        <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูลหมวดย่อยครุภัณฑ์</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">

                            <div class="mb-3">
                                <label for="edit_dep_id" class="col-form-label">เลือกหน่วยงาน</label>
                                <select class="form-select" id="edit_dep_id">
                                    <option selected disabled>กรุณาเลือกหน่วยงาน</option>
                                    <!-- Department options will be populated dynamically via AJAX -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit_category_id" class="col-form-label">เลือกหมวดหลักครุภัณฑ์</label>
                                <select class="form-select" id="edit_category_id" disabled>
                                    <option selected disabled>กรุณาเลือกหมวดหลักครุภัณฑ์</option>
                                    <!-- Options will be populated dynamically -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">ชื่อหมวดย่อยครุภัณฑ์</label>
                                <input type="text" class="form-control" id="edit_name" required>
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
        <!-- <div class="col-md-4"></div> -->

        <!-- First Dropdown -->
        <div class="col-auto">
            <select class="form-select" id="dep_search" aria-label="Dropdown Menu">
                <option>กรุณาเลือกหน่วยงาน</option>
            </select>
        </div>

        <!-- Second Dropdown -->
        <div class="col-auto">
            <select class="form-select" id="cat_search" aria-label="Dropdown Menu">
                <option>กรุณาเลือกหมวดหลักครุภัณฑ์</option>
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
        $(document).ready(function() {
            let originalItems = []; // All items from server
            let filteredItems = []; // Items after filtering

            // Fetch all sub-categories
            $.ajax({
                url: '/spec/getAllSubCategories',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                        return;
                    }

                    console.log("Raw Data:", response);
                    console.log("User Status:", userStatus);
                    console.log("User Department ID:", userDepId);

                    originalItems = response;

                    // Apply role-based filtering
                    if (userStatus == 2) {
                        response = response.filter(item => Number(item.Dep_id) === Number(userDepId));
                    }

                    filteredItems = response;
                    renderTable(filteredItems); // Render initial table
                },
                error: function() {
                    alert('Error fetching data. Please try again later.');
                }
            });

            // ⬇️ Table rendering function
            function renderTable(data) {
                let html = `
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>ชื่อหมวดย่อยครุภัณฑ์</th>
                        <th>หมวดหลักครุภัณฑ์</th>
                        <th>สังกัดหน่วยงาน</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>`;

                data.forEach(item => {
                    html += `
                <tr>
                    <td>${item.Sub_category_name}</td>
                    <td>${item.Category_name}</td>
                    <td>${item.Dep_fullname || '-'}</td>
                    <td>
                        <button class="btn btn-sm btn-warning edit-btn" data-id="${item.Sub_category_id}" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-btn" title="Delete" data-id="${item.Sub_category_id}">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                </tr>`;
                });

                html += `</tbody></table>`;
                $('#items-table').html(html);
            }

            // ⬇️ Search button
            $('#search-btn').click(function() {
                const depSearch = $('#dep_search').val();
                const catSearch = $('#cat_search').val();

                // Filtering
                filteredItems = originalItems.filter(item => {
                    let depMatch = depSearch !== "กรุณาเลือกหน่วยงาน" && depSearch !== "" ? item.Dep_id == depSearch : true;
                    let catMatch = catSearch !== "กรุณาเลือกหมวดหลักครุภัณฑ์" && catSearch !== "" ? item.Category_id == catSearch : true;
                    return depMatch && catMatch;
                });

                renderTable(filteredItems); // Re-render with filters

                // Load categories if dep selected
                if (depSearch !== "กรุณาเลือกหน่วยงาน" && depSearch !== "") {
                    $.ajax({
                        url: '/spec/fetchCategories?dep_id=' + depSearch,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (!response.error) {
                                populateCategoryDropdown(response);
                            }
                        }
                    });
                } else {
                    $('#cat_search').html('<option>กรุณาเลือกหมวดหลักครุภัณฑ์</option>');
                }
            });

            function populateCategoryDropdown(categories) {
                let html = '<option>กรุณาเลือกหมวดหลักครุภัณฑ์</option>';
                categories.forEach(category => {
                    html += `<option value="${category.id}">${category.name}</option>`;
                });
                $('#cat_search').html(html);
            }

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

            // If userStatus != 1, pre-select the department and disable the dropdown
            if (userStatus != 1) {
                // Assuming `userDepId` contains the user's department ID
                $('#dep_id').val(userDepId).prop('disabled', true);
                
                // Trigger department change to load the categories
                $('#dep_id').trigger('change');
            }
        }
    },
    error: function() {
        alert('Failed to fetch departments');
    }
});

// Handle department selection change to populate category dropdown
$('#dep_id').change(function() {
    const depId = $(this).val();
    if (depId) {
        // Enable and show the category dropdown after selecting a department
        $('#category_id').prop('disabled', false);
        $.ajax({
            url: `/spec/getCategories/${depId}`, // Ensure the correct URL
            method: 'GET',
            success: function(response) {
                $('#category_id').empty().append('<option selected>กรุณาเลือกหมวดหลัก</option>');
                if (response.error) {
                    alert(response.error); // Display error if no categories
                } else {
                    response.forEach(category => {
                        $('#category_id').append(
                            `<option value="${category.Category_id}">${category.Category_name}</option>`
                        );
                    });
                }
            },
            error: function() {
                alert('Failed to fetch categories');
            }
        });
    } else {
        // Disable category dropdown if no department selected
        $('#category_id').prop('disabled', true).empty().append('<option selected disabled>กรุณาเลือกหมวดหลัก</option>');
    }
});

// Save handler (unchanged)
$('#saveBtn').on('click', function(e) {
    e.preventDefault();

    const data = {
        category_id: $('#category_id').val(),
        dep_id: $('#dep_id').val(),
        name: $('#name').val(),
    };

    if (!data.category_id || !data.name || !data.dep_id) {
        alert('กรุณากรอกข้อมูลให้ครบถ้วน');
        return;
    }

    $.ajax({
        url: '/spec/saveSubCategory',
        method: 'POST',
        data: data,
        success: function() {
            alert('เพิ่มข้อมูลสำเร็จ');
            location.reload();
        },
        error: function(xhr, status, error) {
            alert('เกิดข้อผิดพลาด');
            console.log(status, error);
        }
    });
});

// Modal reset
$('#addModal').on('hidden.bs.modal', function() {
    $(this).find('form')[0].reset();
    $('#category_id').empty().append('<option selected>กรุณาเลือกหมวดหลัก</option>');
});

        });

        // Edit
$(document).on('click', '.edit-btn', function() {
    const subCategoryId = $(this).data('id'); // Get Sub-category ID from button
    console.log('Sub-category ID:', subCategoryId); // Debugging

    if (!subCategoryId) {
        alert('ID is missing or invalid.');
        return;
    }

    // Clear modal fields before opening
    $('#edit_name').val('');
    $('#edit_dep_id').html('<option selected disabled>Loading...</option>').prop('disabled', true);
    $('#edit_category_id').html('<option selected disabled>กรุณาเลือกหมวดหลักครุภัณฑ์</option>').prop('disabled', true);

    // Set the sub-category ID in the modal's data attribute
    $('#editModal').data('id', subCategoryId);

    // Fetch sub-category details using AJAX
    $.ajax({
        url: '/spec/getSubCategoryDetails/' + subCategoryId,
        type: 'GET',
        success: function(response) {
            if (response.error) {
                alert(response.error);
            } else {
                console.log('Fetched Data:', response); // Debugging

                // Populate fields
                $('#edit_name').val(response.Sub_category_name);

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

                        $('#edit_dep_id').html(options).prop('disabled', false);

                        // Set department, then fetch categories
                        if (response.Dep_id) {
                            $('#edit_dep_id').val(response.Dep_id);

                            // If userStatus != 1, pre-select department and disable dropdown
                            if (userStatus != 1) {
                                $('#edit_dep_id').prop('disabled', true);
                            }

                            // Trigger department change to load categories
                            loadCategories(response.Dep_id, response.Category_id);
                        }
                    }
                });

                // Show the modal
                $('#editModal').modal('show');
            }
        },
        error: function() {
            alert('Failed to fetch sub-category details.');
        }
    });
});

// Function to load categories based on selected department
function loadCategories(depId, selectedCategoryId = null) {
    if (!depId) return;

    $.ajax({
        url: `/spec/getCategories/${depId}`,
        method: 'GET',
        dataType: 'json',
        success: function(categories) {
            let options = '<option selected disabled>กรุณาเลือกหมวดหลักครุภัณฑ์</option>';
            $.each(categories, function(index, category) {
                options += `<option value="${category.Category_id}">${category.Category_name}</option>`;
            });

            $('#edit_category_id').html(options).prop('disabled', false);

            // Set selected category **AFTER** dropdown is updated
            if (selectedCategoryId) {
                setTimeout(() => {
                    $('#edit_category_id').val(selectedCategoryId);
                }, 100);
            }
        },
        error: function() {
            console.error('Error fetching categories.');
            $('#edit_category_id').html('<option selected disabled>เกิดข้อผิดพลาด</option>').prop('disabled', false);
        }
    });
}

// Fix duplicate event listeners by properly unbinding before rebinding
$(document).off('change', '#edit_dep_id').on('change', '#edit_dep_id', function() {
    const depId = $(this).val();
    console.log('Department changed:', depId); // Debugging
    loadCategories(depId);
});

// Save button functionality
$(document).on('click', '#editsaveBtn', function() {
    const subCategoryId = $('#editModal').data('id'); // Get Sub-category ID from the modal
    console.log('Saving Sub-category ID:', subCategoryId); // Debugging

    if (!subCategoryId) {
        alert('ID is missing.');
        return;
    }

    const data = {
        Sub_category_name: $('#edit_name').val(),
        Category_id: $('#edit_category_id').val(),
    };

    // Validate required fields
    if (!data.Sub_category_name || !data.Category_id) {
        alert('กรุณากรอกข้อมูลให้ครบถ้วน');
        return;
    }

    // Send updated data via AJAX
    $.ajax({
        url: '/spec/updateSubCategory/' + subCategoryId,
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
                    url: '/spec/deleteSubCategory/' + equipmentId, // URL to the delete route
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

    // Fetch departments based on user status
    $.ajax({
        url: userStatus == 1 ? '/spec/getDepartments' : `/spec/searchdepbyId/${userDepId}`,
        method: 'GET',
        success: function(response) {
            $('#dep_search').empty().append('<option selected>กรุณาเลือกหน่วยงาน</option>');
            if (response && response.length > 0) {
                response.forEach(function(department) {
                    $('#dep_search').append(
                        `<option value="${department.Department_id}">${department.Dep_fullname}</option>`
                    );
                });
            }
        },
        error: function() {
            alert('Failed to fetch departments');
        }
    });

    // Populate categories when a department is selected
    $('#dep_search').change(function() {
        const depId = $(this).val();
        if (depId) {
            $.ajax({
                url: `/spec/getCategories/${depId}`,
                method: 'GET',
                success: function(response) {
                    $('#cat_search').empty().append('<option selected>กรุณาเลือกหมวดหลักครุภัณฑ์</option>');
                    if (response && response.length > 0) {
                        response.forEach(category => {
                            $('#cat_search').append(
                                `<option value="${category.Category_id}">${category.Category_name}</option>`
                            );
                        });
                    }
                },
                error: function() {
                    // alert('Failed to fetch categories');
                    $('#cat_search').empty().append('<option selected>กรุณาเลือกหมวดหลักครุภัณฑ์</option>');
                }
            });
        } else {
            $('#cat_search').empty().append('<option selected>กรุณาเลือกหมวดหลักครุภัณฑ์</option>');
        }
    });
</script>
<?= $this->endSection() ?>
