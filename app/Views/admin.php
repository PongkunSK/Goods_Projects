<?= $this->extend('layouts/main'); ?>
<?= $this->section('content') ?>
<!-- Main Content -->
<div class="container-fluid content bg-white pb-1" id="content"
    style="margin-top: 80px; box-shadow: 0px 0px 5px 5px rgba(0, 0, 0, 0.09);">
    <p class="fw-bold ps-1 pt-3 pb-3" style="font-size: 18px;">จัดการข้อมูลครุภัณฑ์</p>
    <hr style="color: rgb(157, 157, 157)">

    <!-- Improved Button + Dropdown + Search (Mobile-friendly) -->
    <div class="row row-cols-1 row-cols-md-auto g-2 align-items-center mt-4">
        <!-- Add Item Button -->
        <div class="col">
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#addModal">
                เพิ่มครุภัณฑ์
            </button>
        </div>

        <!-- First Dropdown -->
        <div class="col">
            <select class="form-select w-100" id="dep_search" aria-label="Dropdown Menu">
                <option>กรุณาเลือกหน่วยงาน</option>
            </select>
        </div>

        <!-- Second Dropdown -->
        <div class="col">
            <select class="form-select w-100" id="cat_search" aria-label="Dropdown Menu">
                <option>กรุณาเลือกหมวดหลักครุภัณฑ์</option>
            </select>
        </div>

        <!-- Search Button -->
        <div class="col">
            <button class="btn btn-primary w-100" id="search-btn" title="Search">ค้นหา</button>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">เพิ่มข้อมูลครุภัณฑ์</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm">
                        <div class="mb-3">
                            <label for="equipment_code" class="form-label">รหัสครุภัณฑ์</label>
                            <input type="text" class="form-control" id="equipment_code" required>
                        </div>
                        <div class="mb-3">
                            <label for="equipment_detail" class="form-label">รายละเอียด</label>
                            <textarea class="form-control" id="equipment_detail" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">ราคา</label>
                            <input type="text" class="form-control" id="price" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="dep_id" class="col-form-label">เลือกหน่วยงาน</label>
                            <select class="form-select" id="dep_id">
                                <option selected disabled>กรุณาเลือกหน่วยงาน</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="col-form-label">เลือกหมวดหลักครุภัณฑ์</label>
                            <select class="form-select" id="category_id" disabled>
                                <option selected disabled>กรุณาเลือกหมวดหลักครุภัณฑ์</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="sub_category_id" class="col-form-label">เลือกหมวดย่อยครุภัณฑ์</label>
                            <select class="form-select" id="sub_category_id" disabled>
                                <option selected disabled>กรุณาเลือกหมวดย่อยครุภัณฑ์</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="file_path_pdf" class="col-form-label">อัพโหลดไฟล์ครุภัณฑ์</label>
                            <input type="file" class="form-control" id="file_path_pdf" accept=".pdf">
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
                            <label for="edit_equipment_code" class="form-label">รหัสครุภัณฑ์</label>
                            <input type="text" class="form-control" id="edit_equipment_code" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_equipment_detail" class="form-label">รายละเอียด</label>
                            <textarea class="form-control" id="edit_equipment_detail" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_price" class="form-label">ราคา</label>
                            <input type="text" class="form-control" id="edit_price" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_dep_id" class="col-form-label">เลือกหน่วยงาน</label>
                            <select class="form-select" id="edit_dep_id">
                                <option selected disabled>กรุณาเลือกหน่วยงาน</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_category_id" class="col-form-label">เลือกหมวดหลักครุภัณฑ์</label>
                            <select class="form-select" id="edit_category_id" disabled>
                                <option selected disabled>กรุณาเลือกหมวดหลักครุภัณฑ์</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_sub_category_id" class="col-form-label">เลือกหมวดย่อยครุภัณฑ์</label>
                            <select class="form-select" id="edit_sub_category_id" disabled>
                                <option selected disabled>กรุณาเลือกหมวดย่อยครุภัณฑ์</option>
                            </select>
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

    <!-- Table Options -->
    <div class="row align-items-center" style="margin-top: 40px; margin-left: 20px; border-color: rgb(3, 3, 3);">
        <div class="col-auto">
            <p class="mb-0">แสดง</p>
        </div>
        <div class="col-auto">
            <div class="dropdown col">
                <div class="dropdown-container" style="color: rgb(129, 129, 129); border-color: rgb(196, 196, 196);">
                    <select class="form-select" id="itemsPerPageDropdown" aria-label="Items Per Page">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="ทั้งหมด">ทั้งหมด</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <p class="mb-0">รายการ</p>
        </div>
    </div>

    <div class="mt-4">
        <div id="items-table" class="table-responsive"></div>
    </div>
    <div id="pagination" class="mt-3"></div>
</div>

<script>
    var userStatus = <?php echo json_encode(session()->get('Status_id')); ?>;
    var userDepId = <?php echo json_encode(session()->get('Dep_id')); ?>;

    console.log("User Status:", userStatus);
    console.log("User Department ID:", userDepId);
    $(document).ready(function() {
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

        $(document).ready(function () {
    let itemsPerPage = 50;
    let currentPage = 1;
    let totalPages = 1;
    let originalItems = [];
    let filteredItems = [];

    function paginateGroupedItems(groupedItems, itemsPerPage) {
        const pages = [];
        let currentPage = [];
        let currentCount = 0;

        groupedItems.forEach(group => {
            const { subCat, items } = group;
            let index = 0;

            while (index < items.length) {
                if (currentCount >= itemsPerPage) {
                    pages.push(currentPage);
                    currentPage = [];
                    currentCount = 0;
                }

                if (currentPage.length === 0 || currentPage[currentPage.length - 1]?.subCat !== subCat) {
                    currentPage.push({
                        type: 'header',
                        subCat
                    });
                }

                const remainingSpace = itemsPerPage - currentCount;
                const chunk = items.slice(index, index + remainingSpace);

                chunk.forEach(item => {
                    currentPage.push({
                        type: 'item',
                        subCat,
                        data: item
                    });
                    currentCount++;
                });

                index += chunk.length;
            }
        });

        if (currentPage.length > 0) {
            pages.push(currentPage);
        }

        return pages;
    }

    function renderTable(page) {
        const groupedBySubCategory = {};
        filteredItems.forEach(item => {
            if (!groupedBySubCategory[item.Sub_category_name]) {
                groupedBySubCategory[item.Sub_category_name] = [];
            }
            groupedBySubCategory[item.Sub_category_name].push(item);
        });

        const groupedArray = Object.entries(groupedBySubCategory).map(([subCat, items]) => ({
            subCat,
            items
        }));

        const paginatedPages = paginateGroupedItems(groupedArray, itemsPerPage);
        totalPages = paginatedPages.length;

        const renderList = paginatedPages[page - 1] || [];

        let html = '<table class="table table-bordered table-striped">';
        html += `
            <thead class="table-primary">
                <tr>
                    <th>Spec.No.</th>
                    <th>รายละเอียด</th>
                    <th>ราคาสำนักงบประมาณ</th>
                    <th>ดาวน์โหลด</th>
                    <th>วันที่เพิ่มข้อมูล</th>
                    <th>วันที่ปรับปรุงข้อมูล</th>
                    <th>แสดงสถานะ</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
        `;

        renderList.forEach(entry => {
            if (entry.type === 'header') {
                html += `
                    <tr>
                        <td colspan="8" class="bg-primary text-start text-white">
                            <strong>${entry.subCat}</strong>
                        </td>
                    </tr>
                `;
            } else {
                const item = entry.data;
                const filePath = item.File_path_pdf;
                let downloadBtn = '<span class="text-muted">ไม่มีไฟล์</span>';

                if (filePath && filePath.includes('/')) {
                    const filename = filePath.split('/').pop();
                    downloadBtn = `
                        <a href="/spec/download/${encodeURIComponent(filename)}" class="btn btn-outline-primary btn-sm" title="Download">
                            <i class="bi bi-download"></i> PDF
                        </a>
                    `;
                }

                html += `
                    <tr>
                        <td>${item.Equipment_code}</td>
                        <td>${item.Equipment_details}</td>
                        <td>${item.Price}</td>
                        <td>${downloadBtn}</td>
                        <td>${item.Created_date || '-'}</td>
                        <td>${item.Update_date || '-'}</td>
                        <td>
                            <div class="form-check form-switch d-flex align-items-center">
                                <span class="status-label-left">ซ่อน</span>
                                <input class="form-check-input m-1 status-checkbox" type="checkbox" id="status${item.Equipment_id}" ${item.Equipment_status == 1 ? 'checked' : ''}>
                                <span class="status-label-right">แสดง</span>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning edit-btn" data-id="${item.Equipment_id}" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                            <button class="btn btn-sm btn-danger delete-btn" title="Delete" data-id="${item.Equipment_id}">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </td>
                    </tr>
                `;
            }
        });

        html += '</tbody></table>';
        $('#items-table').html(html);
    }

    function renderPagination() {
        let paginationHtml = '<nav><ul class="pagination justify-content-center">';
        paginationHtml += `
            <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                <a class="page-link prev-btn" href="#">Prev</a>
            </li>
        `;

        for (let i = 1; i <= totalPages; i++) {
            paginationHtml += `
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link page-number" href="#" data-page="${i}">${i}</a>
                </li>
            `;
        }

        paginationHtml += `
            <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                <a class="page-link next-btn" href="#">Next</a>
            </li>
        `;

        paginationHtml += '</ul></nav>';
        $('#pagination').html(paginationHtml);
    }

    function updatePagination() {
        const groupedBySubCategory = {};
        filteredItems.forEach(item => {
            if (!groupedBySubCategory[item.Sub_category_name]) {
                groupedBySubCategory[item.Sub_category_name] = [];
            }
            groupedBySubCategory[item.Sub_category_name].push(item);
        });

        const groupedArray = Object.entries(groupedBySubCategory).map(([subCat, items]) => ({
            subCat,
            items
        }));

        const paginatedPages = paginateGroupedItems(groupedArray, itemsPerPage);
        totalPages = paginatedPages.length;

        renderPagination();
        renderTable(currentPage);
    }

    $.ajax({
        url: '/spec/fetchAllItems',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.error) {
                alert(response.error);
                return;
            }

            if (userStatus == 2) {
                response = response.filter(item => Number(item.Dep_id) === Number(userDepId));
            }

            originalItems = response;
            filteredItems = response;
            updatePagination();
        },
        error: function () {
            alert('Error fetching data. Please try again later.');
        }
    });

    $('#search-btn').click(function () {
        const depSearch = $('#dep_search').val();
        const catSearch = $('#cat_search').val();

        filteredItems = originalItems.filter(item => {
            let depMatch = depSearch !== "กรุณาเลือกหน่วยงาน" ? item.Dep_id == depSearch : true;
            let catMatch = catSearch !== "กรุณาเลือกหมวดหลักครุภัณฑ์" ? item.Category_id == catSearch : true;
            return depMatch && catMatch;
        });

        currentPage = 1;
        updatePagination();

        if (depSearch !== "กรุณาเลือกหน่วยงาน" && depSearch !== "") {
            $.ajax({
                url: '/spec/fetchCategories?dep_id=' + depSearch,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
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

    $('#itemsPerPageDropdown').change(function () {
        let selectedValue = $(this).val();
        itemsPerPage = selectedValue === 'ทั้งหมด' ? 999999 : parseInt(selectedValue);
        currentPage = 1;
        updatePagination();
    });

    $(document).on('click', '.page-number', function (e) {
        e.preventDefault();
        currentPage = parseInt($(this).data('page'));
        renderTable(currentPage);
        renderPagination();
    });

    $(document).on('click', '.next-btn', function (e) {
        e.preventDefault();
        if (currentPage < totalPages) {
            currentPage++;
            renderTable(currentPage);
            renderPagination();
        }
    });

    $(document).on('click', '.prev-btn', function (e) {
        e.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            renderTable(currentPage);
            renderPagination();
        }
    });
});

        // Attach event listener to checkbox changes
        $(document).on('change', '.status-checkbox', function() {
            const equipmentId = $(this).attr('id').replace('status', '');
            const newStatus = $(this).is(':checked') ? 1 : 0;

            // Send the updated status to the server
            $.ajax({
                url: '/spec/updateEquipmentStatus', // Endpoint to update equipment status
                type: 'POST',
                data: {
                    Equipment_id: equipmentId,
                    Equipment_status: newStatus
                },
                success: function(response) {
                    if (response.success) {
                        // alert('Status updated successfully');
                    } else {
                        // alert('Failed to update status');
                    }
                },
                error: function() {
                    alert('Error updating status. Please try again later.');
                }
            });
        });

        // Function to reset the modal content
function resetModal() {
    // Reset department dropdown to default
    $('#dep_id').prop('disabled', false).val('').empty().append('<option selected>กรุณาเลือกหน่วยงาน</option>');
    // Reset category dropdown
    $('#category_id').prop('disabled', true).val('').empty().append('<option selected disabled>กรุณาเลือกหมวดหลัก</option>');
    // Reset subcategory dropdown
    $('#sub_category_id').prop('disabled', true).val('').empty().append('<option selected disabled>กรุณาเลือกหมวดย่อย</option>');

    // Reinitialize departments based on user status
    loadDepartments();
}

// Function to populate the department dropdown based on user status
function loadDepartments() {
    if (userStatus == 1) {
        // If userStatus is 1, allow selection of all departments
        $('#dep_id').prop('disabled', false);
        $.ajax({
            url: '/spec/getDepartments', // Fetch all departments
            method: 'GET',
            success: function(response) {
                $('#dep_id').empty().append('<option selected>กรุณาเลือกหน่วยงาน</option>');
                if (response.error) {
                    alert(response.error);
                } else {
                    response.forEach(department => {
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
    } else if (userStatus == 2) {
        // If userStatus is 2, pre-select the associated department
        $.ajax({
            url: `/spec/getDepartmentDetails/${userDepId}`, // Fetch the department by ID
            method: 'GET',
            success: function(response) {
                if (response.error) {
                    alert(response.error);
                } else {
                    // Pre-select the department if userStatus is 2
                    $('#dep_id').empty().append(
                        `<option selected value="${response.Department_id}">${response.Dep_fullname}</option>`
                    );
                    $('#dep_id').prop('disabled', true); // Disable the dropdown so the user cannot change it

                    // Manually trigger the 'change' event to populate categories
                    $('#dep_id').trigger('change');
                }
            },
            error: function() {
                alert('Failed to fetch the department');
            }
        });
    }
}

// When modal is opened, reset it and select the department based on user status
$('#addModal').on('show.bs.modal', function () {
    resetModal();
});

// Reset the modal every time it is closed
$('#addModal').on('hidden.bs.modal', function () {
    resetModal();
});

// Handle department selection change
$('#dep_id').change(function() {
    const depId = $(this).val();
    console.log("Department selected:", depId); // Debug log to check if department is selected correctly
    if (depId) {
        // Reset and enable the category dropdown after selecting a department
        $('#category_id').prop('disabled', false).empty().append('<option selected>กรุณาเลือกหมวดหลัก</option>');
        $('#sub_category_id').prop('disabled', true).empty().append('<option selected disabled>กรุณาเลือกหมวดย่อย</option>'); // Reset subcategory dropdown

        $.ajax({
            url: `/spec/getCategories/${depId}`, // Ensure the correct URL
            method: 'GET',
            success: function(response) {
                console.log("Categories response:", response); // Debug log to check category response
                if (response.error) {
                    alert(response.error); // Display error if no categories
                } else {
                    // Populate the category dropdown
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
        $('#sub_category_id').prop('disabled', true).empty().append('<option selected disabled>กรุณาเลือกหมวดย่อย</option>');
    }
});

// Handle category selection change
$('#category_id').change(function() {
    const categoryId = $(this).val();
    console.log("Category selected:", categoryId); // Debug log to check if category is selected correctly
    if (categoryId) {
        // Enable subcategory dropdown after selecting a category
        $('#sub_category_id').prop('disabled', false).empty().append('<option selected>กรุณาเลือกหมวดย่อย</option>');
        $.ajax({
            url: `/spec/getSubCategories/${categoryId}`, // Ensure the correct URL
            method: 'GET',
            success: function(response) {
                console.log("Subcategories response:", response); // Debug log to check subcategory response
                if (response.error) {
                    alert(response.error);
                    $('#sub_category_id').empty().append('<option selected disabled>กรุณาเลือกหมวดย่อย</option>');
                } else {
                    // Populate the subcategory dropdown
                    $('#sub_category_id').empty().append('<option selected>กรุณาเลือกหมวดย่อย</option>');
                    response.forEach(subCategory => {
                        $('#sub_category_id').append(
                            `<option value="${subCategory.Sub_category_id}">${subCategory.Sub_category_name}</option>`
                        );
                    });
                }
            },
            error: function() {
                alert('Failed to fetch subcategories');
            }
        });
    } else {
        // Disable subcategory dropdown if no category selected
        $('#sub_category_id').prop('disabled', true).empty().append('<option selected disabled>กรุณาเลือกหมวดย่อย</option>');
    }
});

        // Handle form submission
        $('#saveBtn').on('click', function(e) {
            e.preventDefault();

            let formData = new FormData();
            formData.append('code', $('#equipment_code').val());
            formData.append('detail', $('#equipment_detail').val());
            formData.append('price', $('#price').val());
            formData.append('dep_id', $('#dep_id').val());
            formData.append('category_id', $('#category_id').val());
            formData.append('sub_category_id', $('#sub_category_id').val());
            formData.append('file', $('#file_path_pdf')[0].files[0]);

            // Check if all fields are filled
            if (![...formData.values()].every(value => value)) {
                alert('กรุณากรอกข้อมูลให้ครบถ้วน');
                return;
            }

            $.ajax({
                url: '/spec/saveEquipment',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
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
            $('#category_id').empty().append('<option selected>กรุณาเลือกหมวดหลัก</option>');
            $('#sub_category_id').empty().append('<option selected>กรุณาเลือกหมวดย่อย</option>');
        });
    });

    $(document).on('click', '.edit-btn', function() {
    const equipmentId = $(this).data('id'); // Get Equipment ID
    console.log('Equipment ID:', equipmentId);

    if (!equipmentId) {
        alert('Equipment ID is missing or invalid.');
        return;
    }

    // Clear modal fields before opening
    $('#edit_equipment_code, #edit_equipment_detail, #edit_price').val('');
    $('#edit_dep_id, #edit_category_id, #edit_sub_category_id')
        .html('<option selected disabled>Loading...</option>')
        .prop('disabled', true);

    $('#editModal').data('id', equipmentId);

    // Fetch equipment details using AJAX
    $.ajax({
        url: '/spec/getEquipmentDetails/' + equipmentId,
        type: 'GET',
        success: function(response) {
            if (response.error) {
                alert(response.error);
            } else {
                // Populate fields
                $('#edit_equipment_code').val(response.Equipment_code);
                $('#edit_equipment_detail').val(response.Equipment_details);
                $('#edit_price').val(response.Price);

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

                        // If userStatus != 1, pre-select department and disable it
                        if (userStatus != 1) {
                            $('#edit_dep_id').html(options)
                                .val(response.Dep_id)  // Pre-select department
                                .prop('disabled', true); // Disable department dropdown
                        } else {
                            // If userStatus == 1, allow user to select a department
                            $('#edit_dep_id').html(options)
                                .val(response.Dep_id)  // Set the current department
                                .prop('disabled', false); // Enable department dropdown
                        }

                        // Trigger department change event to load categories
                        $('#edit_dep_id').trigger('change');
                    }
                });

                // Handle department change to load categories
                $('#edit_dep_id').off('change').on('change', function() {
                    const depId = $(this).val();
                    if (depId) {
                        $.ajax({
                            url: `/spec/getCategories/${depId}`,
                            method: 'GET',
                            dataType: 'json',
                            success: function(categories) {
                                let options = '<option selected disabled>กรุณาเลือกหมวดหลักครุภัณฑ์</option>';
                                $.each(categories, function(index, category) {
                                    options += `<option value="${category.Category_id}">${category.Category_name}</option>`;
                                });

                                $('#edit_category_id').html(options).prop('disabled', false).val(response.Category_id).trigger('change');
                            }
                        });
                    }
                });

                // Handle category change to load sub-categories
                $('#edit_category_id').off('change').on('change', function() {
                    const categoryId = $(this).val();
                    if (categoryId) {
                        $.ajax({
                            url: `/spec/getSubCategories/${categoryId}`,
                            method: 'GET',
                            dataType: 'json',
                            success: function(subCategories) {
                                let options = '<option selected disabled>กรุณาเลือกหมวดย่อยครุภัณฑ์</option>';
                                $.each(subCategories, function(index, subCategory) {
                                    options += `<option value="${subCategory.Sub_category_id}">${subCategory.Sub_category_name}</option>`;
                                });

                                $('#edit_sub_category_id').html(options).prop('disabled', false).val(response.Sub_category_id);
                            }
                        });
                    }
                });

                $('#editModal').modal('show');
            }
        },
        error: function() {
            alert('Failed to fetch equipment details.');
        }
    });
});

// Save button functionality
$(document).on('click', '#editsaveBtn', function() {
    const equipmentId = $('#editModal').data('id'); // Get Sub-category ID from the modal
    console.log('Saving ID:', equipmentId); // Debugging

    if (!equipmentId) {
        alert('ID is missing.');
        return;
    }

    const data = {
        Equipment_code: $('#edit_equipment_code').val(),
        Equipment_details: $('#edit_equipment_detail').val(),
        Price: $('#edit_price').val(),
        Dep_id: $('#edit_dep_id').val(),
        Category_id: $('#edit_category_id').val(),
        Sub_category_id: $('#edit_sub_category_id').val(),
    };

    // Validate required fields
    if (!data.Equipment_code || !data.Equipment_details) {
        alert('กรุณากรอกข้อมูลให้ครบถ้วน');
        return;
    }

    // Send updated data via AJAX
    $.ajax({
        url: '/spec/updateEquipment/' + equipmentId,
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
                url: '/spec/deleteEquipment/' + equipmentId, // URL to the delete route
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