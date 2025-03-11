<table>
    <thead>
        <tr>
            <th>Dynamic Field</th>
            <th>Field Value</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody id="table-maintenance">
    </tbody>
    
</table>

<script>

    document.addEventListener("DOMContentLoaded", function () {

        skeletonLoaderMaintenance();

        setTimeout(() => {
            loadDataMaintenance();
        }, 1000);

        // search
        document.getElementById("search-bar-maintenance").addEventListener("input", function (e){
            searchQuery = e.target.value;
            loadDataMaintenance();
        });
        // sort
        document.getElementById("sort-by-maintenance").addEventListener("change", function (e) {
            const selectedSort = e.target.value;
            
            // Find the LAST underscore (to separate column name and order)
            const lastUnderscoreIndex = selectedSort.lastIndexOf("_");

            // Extract sortBy (everything before the last underscore)
            sortBy = selectedSort.substring(0, lastUnderscoreIndex);

            // Extract sortOrder (everything after the last underscore)
            sortOrder = selectedSort.substring(lastUnderscoreIndex + 1);

            loadDataMaintenance(); // Pass correct values to your function

        });

    });
    
    function loadDataMaintenance() {
        fetch(`/fetch-maintenance-value-data?page=${currentPage}&search=${searchQuery}&sort_by=${sortBy}&sort_order=${sortOrder}`)
            .then(response => response.json())
            .then(data => {
                totalPages = data.last_page;
                const tableBody = document.getElementById('table-maintenance');

                tableBody.innerHTML = '';

                // Define a mapping object for renaming keys
                const categoryMapping = {
                    ps_no: "PS No.",
                    hatcher_no: "Hatcher No.",
                    house_no: "House No.",
                    incubator_no: "Incubator No.",
                };

                data.data.forEach(row => {

                // Use mapped value, fallback to original if not found
                let displayCategory = categoryMapping[row.data_category] || row.data_category;

                    tableBody.innerHTML += `
                        <tr id="row-${row.id}">
                            <td>${displayCategory}</td>
                            <td>${row.data_value}</td>
                            <td class="datalist-actions">
                                <i class="fa-regular fa-pen-to-square load" id="edit-action" onclick="showModalMaintenance('edit', ${row.id})"></i>
                                <i class="fa-regular fa-trash-can" id="delete-action" onclick="showModalMaintenance('delete', ${row.id})"></i>
                            </td>
                        </tr>
                    `;   
                });
                
                updatePaginationMaintenance();
                loadingScreen(); // Running a function after data is loaded to read all load class
            })
            .catch(error => console.log("Error fetching data", error));
    }

    function refreshTableMaintenance() {
        const tableBody = document.getElementById('table-maintenance');
        tableBody.innerHTML = '';

        skeletonLoaderMaintenance();
        
        setTimeout(() => {
            loadDataMaintenance();
        }, 1000);

        updatePaginationMaintenance();
    }

    //Pagination Function
    function updatePaginationMaintenance() {
        const paginationContainer = document.getElementById("pagination-maintenance");
        paginationContainer.innerHTML = "";

        if (currentPage > 1) {
            paginationContainer.innerHTML += `<a href="#" onclick="changePageMaintenance(event, ${currentPage - 1})"><i class="fa-solid fa-caret-left"></i></a>`;
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
                paginationContainer.innerHTML += `<a href="#" onclick="changePageMaintenance(event, ${i})">${i}</a>`;
            }
        }

        if (currentPage < totalPages) {
            paginationContainer.innerHTML += `<a href="#" onclick="changePageMaintenance(event, ${currentPage + 1})"><i class="fa-solid fa-caret-right"></i></a>`;
        }
    }

    function changePageMaintenance(event, page) {
        event.preventDefault(); // Prevents default anchor behavior
        if (page >= 1 && page <= totalPages) {
            currentPage = page;
            loadDataMaintenance();
        }
    }

    //Skeleton Loader Function
    function skeletonLoaderMaintenance(){
        const tableBody = document.getElementById('table-maintenance');

        for (let i = 0; i < 5; i++) { // 5 rows
            const row = document.createElement("tr");
            
            for (let j = 0; j < 3; j++) { // 3 columns per row
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