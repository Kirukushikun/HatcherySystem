<table>
    <thead>
        <tr>
            <th>Dynamic Field</th>
            <th>Field Value</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="table-body">
    </tbody>
</table>

<script>
    let currentPage = 1;
    let totalPages = 1;
    let searchQuery = "";
    let sortBy = "created_at";
    let sortOrder = "desc";

    document.addEventListener("DOMContentLoaded", function () {

        skeletonLoader();

        setTimeout(() => {
            loadData();
        }, 1000);

        // Attach event listeners to search and sort inputs
        document.querySelector(".search-bar input").addEventListener("input", function (e) {
            searchQuery = e.target.value;
            currentPage = 1;
            loadData();
        });

        document.querySelector(".sort-btn").addEventListener("change", function (e) {
            const selectedSort = e.target.value;
            
            // Find the LAST underscore (to separate column name and order)
            const lastUnderscoreIndex = selectedSort.lastIndexOf("_");

            // Extract sortBy (everything before the last underscore)
            sortBy = selectedSort.substring(0, lastUnderscoreIndex);

            // Extract sortOrder (everything after the last underscore)
            sortOrder = selectedSort.substring(lastUnderscoreIndex + 1);

            loadData(); // Pass correct values to your function
        });
    });

    function loadData() {
        fetch(`/fetch-maintenance-value-data?page=${currentPage}&search=${searchQuery}&sort_by=${sortBy}&sort_order=${sortOrder}`)
            .then(response => response.json())
            .then(data => {
                totalPages = data.last_page;
                const tableBody = document.getElementById('table-body');

                tableBody.innerHTML = '';
                data.data.forEach(row => {
                    let setting_date = new Date(row.setting_date).toLocaleDateString();
                    let temperature_check_date = new Date(row.temperature_check_date).toLocaleDateString();

                    tableBody.innerHTML += `
                        <tr id="row-${row.id}">
                            <td>${row.data_category}</td>
                            <td>${row.data_value}</td>
                            <td class="datalist-actions">
                                <i class="fa-regular fa-pen-to-square load" id="edit-action" onclick="showModal('edit', ${row.id})"></i>
                                <i class="fa-regular fa-trash-can" id="delete-action" onclick="showModal('delete', ${row.id})"></i>
                            </td>
                        </tr>
                    `;   
                });

                updatePagination();
                loadingScreen(); // Running a function after data is loaded to read all load class
            })
            .catch(error => console.log("Error fetching data", error));
    }
    function refreshTable() {
        const tableBody = document.getElementById('table-body');
        tableBody.innerHTML = '';

        skeletonLoader();
        
        setTimeout(() => {
            loadData();
        }, 1000);

        updatePagination();
    }

    //Pagination Function
    function updatePagination() {
        const paginationContainer = document.querySelector(".pagination");
        paginationContainer.innerHTML = "";

        if (currentPage > 1) {
            paginationContainer.innerHTML += `<a href="#" onclick="changePage(event, ${currentPage - 1})"><i class="fa-solid fa-caret-left"></i></a>`;
        }

        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, startPage + 4);

        if (endPage - startPage < 4) {
            startPage = Math.max(1, endPage - 4);
        }

        for (let i = startPage; i <= endPage; i++) {
            if (i === currentPage) {
                paginationContainer.innerHTML += `<a href="#" class="active">${i}</a>`;
            } else {
                paginationContainer.innerHTML += `<a href="#" onclick="changePage(event, ${i})">${i}</a>`;
            }
        }

        if (currentPage < totalPages) {
            paginationContainer.innerHTML += `<a href="#" onclick="changePage(event, ${currentPage + 1})"><i class="fa-solid fa-caret-right"></i></a>`;
        }
    }

    function changePage(event, page) {
        event.preventDefault(); // Prevents default anchor behavior
        if (page >= 1 && page <= totalPages) {
            currentPage = page;
            loadData();
        }
    }

    //Skeleton Loader Function
    function skeletonLoader(){
        const tableBody = document.getElementById('table-body');

        for (let i = 0; i < 10; i++) { // 10 rows
            const row = document.createElement("tr");
            
            for (let j = 0; j < 10; j++) { // 10 columns per row
                let ranWidth = Math.floor(Math.random() * (100 - 50 + 1) + 50) + "%";
                const cell = document.createElement("td");
                const skeleton = document.createElement("div");
                skeleton.classList.add("skeleton");
                skeleton.style.width = ranWidth; // Full width
                cell.appendChild(skeleton);
                row.appendChild(cell);
            }
            tableBody.appendChild(row);
        }
    }

</script>