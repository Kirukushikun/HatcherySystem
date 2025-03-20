<table>
    <thead>
        <tr>
            <th>Action Done</th>
            <th>Table</th>
            <th>User</th>
            <th>Values</th>
        </tr>
    </thead>
    
    <tbody id="table-audit">
    </tbody>
    
</table>

<script>

    document.addEventListener("DOMContentLoaded", function () {

        skeletonLoaderAudit();

        setTimeout(() => {
            loadDataAudit();
        }, 1000);

        // search
        document.getElementById("search-bar-audit").addEventListener("input", function (e) {
            searchQuery = e.target.value;
            loadDataAudit();
        });

        // sort
        document.getElementById("sort-by-audit").addEventListener("change", function (e) {
            const selectedSort = e.target.value;
            
            // Find the LAST underscore (to separate column name and order)
            const lastUnderscoreIndex = selectedSort.lastIndexOf("_");

            // Extract sortBy (everything before the last underscore)
            sortBy = selectedSort.substring(0, lastUnderscoreIndex);

            // Extract sortOrder (everything after the last underscore)
            sortOrder = selectedSort.substring(lastUnderscoreIndex + 1);

            loadDataAudit(); // Pass correct values to your function

        });   
    });

    function loadDataAudit() {
        fetch(`/fetch-audit-trail-data?page=${currentPage}&search=${searchQuery}&sort_by=${sortBy}&sort_order=${sortOrder}`)
            .then(response => response.json())
            .then(data => {
                totalPages = data.last_page;
                const tableBody = document.getElementById('table-audit');

                tableBody.innerHTML = '';

                // Define a mapping object for renaming keys
                const tableMapping = {
                    egg_collection: "Egg Collection Entry",
                    egg_temperature: "Egg Temperature Entry",
                    rejected_hatch: "Rejected Hatch Entry",
                    rejected_pullets: "Rejected Pullets Entry",
                    users: "Users",
                };

                data.data.forEach(row => {

                // Use mapped value, fallback to original if not found
                let displayTable = tableMapping[row.table] || row.table;

                    tableBody.innerHTML += `
                        <tr id="row-${row.id}">
                            <td>${row.action}</td>
                            <td>${displayTable}</td>
                            <td>${row.user_id}</td>
                            <td>
                            <button style="width: 100%;color: white;background-color: #EC8B18;border: none;padding: 5px;border-radius: 7px;cursor: pointer;font-size: 15px;" onclick="showModalAudit('view', ${row.id})">View</button>
                            </td>
                        </tr>
                    `;   
                });
                
                updatePaginationAudit();
                loadingScreen(); // Running a function after data is loaded to read all load class
            })
            .catch(error => console.log("Error fetching data", error));
    }
    function refreshTableAudit() {
        const tableBody = document.getElementById('table-audit');
        tableBody.innerHTML = '';

        skeletonLoaderAudit();   
        
        setTimeout(() => {
            loadDataAudit();
        }, 1000);

        updatePaginationAudit();
    }

    //Pagination Function
    function updatePaginationAudit() {
        const paginationContainer = document.getElementById("pagination-audit");
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
            loadDataAudit();
        }
    }

    //Skeleton Loader Function
    function skeletonLoaderAudit(){
        const tableBody = document.getElementById('table-audit');

        for (let i = 0; i < 10; i++) { // 10 rows
            const row = document.createElement("tr");
            
            for (let j = 0; j < 4; j++) { // 4 columns per row
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

