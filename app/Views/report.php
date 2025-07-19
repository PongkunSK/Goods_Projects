<?= $this->extend('layouts/main'); ?>
<?= $this->section('content') ?>
<!-- Content -->
<div class="container-fluid content bg-white" id="content" style=" margin-top: 90px;">
    <p class="fw-bold ps-1 pt-3 pb-3" style=" font-size: 18px; ">รายงานครุภัณฑ์</p>
    <hr style="color: rgb(157, 157, 157)">
    <div class="row align-items-center mt-4">
        <!-- Add Item Button -->
        <div class="col-auto">
            <button type="button" class="btn btn-primary" id="export-btn">ออกรายงาน</button> <!-- Export Button -->
        </div>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script> <!-- Include SheetJS -->
<script>
    var userStatus = <?php echo json_encode(session()->get('Status_id')); ?>;
    var userDepId = <?php echo json_encode(session()->get('Dep_id')); ?>;
    $(document).ready(function() {
        let originalItems = [];
        let filteredItems = [];

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
                        $('#cat_search').empty().append('<option selected>กรุณาเลือกหมวดหลักครุภัณฑ์</option>');
                    }
                });
            } else {
                $('#cat_search').empty().append('<option selected>กรุณาเลือกหมวดหลักครุภัณฑ์</option>');
            }
        });

        // Function to convert date to Thai format (e.g., 8 มี.ค. 2562)
        function formatThaiDate(dateString) {
            if (!dateString) return '-';
            
            const months = [
                "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.",
                "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."
            ];
            
            const date = new Date(dateString);
            
            const day = date.getDate();
            const month = months[date.getMonth()];
            const year = date.getFullYear() + 543; // Add 543 for Thai year

            return `${day} ${month} ${year}`;
        }

        // Function to render the table with filtered data, grouped by sub-category
        function renderTable() {
            let html = '';
            if (filteredItems.length > 0) {
                // Group items by sub-category
                const groupedBySubCategory = {};
                filteredItems.forEach(item => {
                    if (!groupedBySubCategory[item.Sub_category_name]) {
                        groupedBySubCategory[item.Sub_category_name] = [];
                    }
                    groupedBySubCategory[item.Sub_category_name].push(item);
                });

                html += '<table class="table table-bordered table-striped">';
                html += ` 
                    <thead class="table-primary">
                        <tr>
                            <th>Spec. No.</th>
                            <th>รายละเอียด</th>
                            <th>ราคาสำนักงบประมาณ</th>
                            <th>วันที่เพิ่มข้อมูล</th>
                            <th>วันที่ปรับปรุงข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                `;

                let totalItemCount = 0;

                // Loop through each group (sub-category)
                Object.keys(groupedBySubCategory).forEach(subCat => {
                    const items = groupedBySubCategory[subCat];
                    totalItemCount += items.length; // Increment total item count

                    html += `
                        <tr>
                            <td colspan="8" class="bg-primary text-start text-white">
                                <strong>${subCat}</strong>
                            </td>
                        </tr>
                    `;
                    
                    // Loop through each item in the sub-category
                    items.forEach(item => {
                        html += `
                            <tr>
                                <td>${item.Equipment_code}</td>
                                <td>${item.Equipment_details}</td>
                                <td>${new Intl.NumberFormat().format(item.Price)}.-</td>
                                <td>${formatThaiDate(item.Created_date)}</td>
                                <td>${formatThaiDate(item.Update_date)}</td>
                            </tr>
                        `;
                    });

                    // Add a row with the total count for each sub-category
                    html += `
                        <tr>
                            <td colspan="8" class="bg-light text-start text-dark">
                                <strong>รวมจำนวน ${items.length} รายการ</strong>
                            </td>
                        </tr>
                    `;
                });

                // Add a row at the end with the total count of items
                html += `
                    <tr>
                        <td colspan="8" class="bg-secondary text-start text-white">
                            <strong>รวมทั้งหมดจำนวน ${totalItemCount} รายการ</strong>
                        </td>
                    </tr>
                `;

                html += '</tbody></table>';
            } else {
                html = '<p>No data found.</p>';
            }

            $('#items-table').html(html);
        }

        // Function to update filteredItems based on search criteria
        function updateFilteredItems() {
            const depSearch = $('#dep_search').val();
            const catSearch = $('#cat_search').val();

            filteredItems = originalItems.filter(item => {
                let depMatch = depSearch !== "กรุณาเลือกหน่วยงาน" ? item.Dep_id == depSearch : true;
                let catMatch = catSearch !== "กรุณาเลือกหมวดหลักครุภัณฑ์" ? item.Category_id == catSearch : true;
                return depMatch && catMatch;
            });

            renderTable();
        }

        // Fetch items from the server
        $.ajax({
            url: '/spec/fetchAllItems',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    alert(response.error);
                    return;
                }

                if (userStatus == 2) {
                    response = response.filter(item => Number(item.Dep_id) === Number(userDepId));
                }

                originalItems = response;
                filteredItems = response;
                renderTable();
            },
            error: function() {
                alert('Error fetching data. Please try again later.');
            }
        });

        // Search functionality
        $('#search-btn').click(function() {
            updateFilteredItems();
        });

        // Export to Excel
        $('#export-btn').click(function() {
            const table = $('#items-table table');
            if (table.length > 0) {
                const wb = XLSX.utils.table_to_book(table[0], {sheet: 'รายงานครุภัณฑ์'});

                // Adjust column widths dynamically based on content length
                const ws = wb.Sheets['รายงานครุภัณฑ์'];
                const range = XLSX.utils.decode_range(ws['!ref']); // Get the range of the sheet

                // Loop through all columns and set column width based on the longest cell in each column
                for (let col = range.s.c; col <= range.e.c; col++) {
                    let maxLength = 10; // Default minimum width
                    for (let row = range.s.r; row <= range.e.r; row++) {
                        const cell = ws[XLSX.utils.encode_cell({r: row, c: col})];
                        if (cell && cell.v) {
                            maxLength = Math.max(maxLength, String(cell.v).length);
                        }
                    }
                    // Set the width based on the longest cell value
                    ws['!cols'] = ws['!cols'] || [];
                    ws['!cols'][col] = { wpx: maxLength * 10 }; // Adjust column width (multiplied for spacing)
                }

                // Export the file
                XLSX.writeFile(wb, 'รายงานครุภัณฑ์.xlsx');
            } else {
                alert('No data available to export');
            }
        });
    });
</script>
<?= $this->endSection() ?>