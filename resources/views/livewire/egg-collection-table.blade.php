<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>PS no.</th>
            <th>House No.</th>
            <th>Production Date</th>
            <th>Collection Time (hh:mm)</th>
            <th>Collected Eggs Quantity</th>
            <th>Encoded/Modified By</th>
            <th>Actions</th>
            <!-- <th>Date Encoded/Modified</th> -->
            <!-- <th>Action Done</th> -->
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
    let sortOrder = "asc";

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
    function loadData() {
        fetch(`/fetch-egg-collection-data?page=${currentPage}&search=${searchQuery}&sort_by=${sortBy}&sort_order=${sortOrder}`)
            .then(response => response.json())
            .then(data => {
                totalPages = data.last_page;
                const tableBody = document.getElementById('table-body');
                tableBody.innerHTML = '';
                data.data.forEach(row => {
                    let production_date = new Date(row.production_date).toLocaleDateString();
                    tableBody.innerHTML += `
                        <tr>
                            <td>${row.id}</td>
                            <td>${row.ps_no}</td>
                            <td>${row.house_no}</td>
                            <td>${production_date}</td>
                            <td>${row.collection_time}</td>
                            <td>${row.collected_qty}</td>
                            <td>${row.encoded_by}</td>
                            <td class="datalist-actions">
                                <i class="fa-regular fa-pen-to-square load" id="edit-action" onclick="showModal('edit', ${row.id})"></i>
                                <i class="fa-regular fa-trash-can" id="delete-action" onclick="showModal('delete', ${row.id})"></i>
                                <i class="fa-solid fa-print" id="print-action"></i>
                            </td>
                        </tr>
                    `;
                });
                updatePagination();
                loadingScreen();
            })
            .catch(error => console.log("Error fetching data", error));
    }
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
</script>