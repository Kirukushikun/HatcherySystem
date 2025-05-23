<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>PS No.</th>
            <th>Incubator No.</th>
            <th>Hatcher No.</th>
            <th>Set Egg QTY</th>

            <th>Unhatched</th>
            <th>Pips</th>
            <th>Rejected Chicks</th>
            <th>Dead Chicks</th>
            <th>Rotten</th>

            <th>Total Rejects QTY</th>
            <th>Total Rejects %</th>

            <th>Production Date (From)</th>
            <th>Production Date (To)</th>
            <th>Hatch Date</th>
            <th>QC Date</th>

            <!-- <th>Encoded/Modified By</th>
            <th>Date Encoded/Modified</th>
            <th>Action Done</th> -->

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
        fetch(`/fetch-rejected-hatch-data?page=${currentPage}&search=${searchQuery}&sort_by=${sortBy}&sort_order=${sortOrder}`)
            .then(response => response.json())
            .then(data => {
                totalPages = data.last_page;
                const tableBody = document.getElementById('table-body');

                tableBody.innerHTML = '';
                data.data.forEach(row => {
                    let production_date_from = new Date(row.production_date_from).toLocaleDateString();
                    let production_date_to = new Date(row.production_date_to).toLocaleDateString();
                    let hatch_date = new Date(row.hatch_date).toLocaleDateString();
                    let qc_date = new Date(row.qc_date).toLocaleDateString();

                    // Parse rejected_hatch_data JSON
                    let rejectedHatchData = {
                        unhatched: { qty: 0, percentage: 0 },
                        pips: { qty: 0, percentage: 0 },
                        rejected_chicks: { qty: 0, percentage: 0 },
                        dead_chicks: { qty: 0, percentage: 0 },
                        rotten: { qty: 0, percentage: 0 }
                    };

                    try {
                        let parsedData = JSON.parse(row.rejected_hatch_data);
                        rejectedHatchData = { ...rejectedHatchData, ...parsedData }; // Merge with defaults
                    } catch (error) {
                        console.error("Error parsing rejected_hatch_data:", error);
                    }

                    tableBody.innerHTML += `
                        <tr id="row-${row.id}">
                            <td>${row.id}</td>
                            <td>${row.ps_no}</td>
                            <td class="tag-container">
                                ${row.incubator_no.map(h => {
                                    const width = h < 10 ? '3ch' : '4ch';
                                    return `<span style="width:${width};">${h}</span>`;
                                }).join(' ')}
                            </td>
                            <td class="tag-container">
                                ${row.hatcher_no.map(h => {
                                    const width = h < 10 ? '3ch' : '4ch';
                                    return `<span style="width:${width};">${h}</span>`;
                                }).join(' ')}
                            </td>
                            <td>${row.set_eggs_qty}</td>

                            <td>${rejectedHatchData.unhatched.qty} (${rejectedHatchData.unhatched.percentage}%)</td>
                            <td>${rejectedHatchData.pips.qty} (${rejectedHatchData.pips.percentage}%)</td>
                            <td>${rejectedHatchData.rejected_chicks.qty} (${rejectedHatchData.rejected_chicks.percentage}%)</td>
                            <td>${rejectedHatchData.dead_chicks.qty} (${rejectedHatchData.dead_chicks.percentage}%)</td>
                            <td>${rejectedHatchData.rotten.qty} (${rejectedHatchData.rotten.percentage}%)</td>
                            
                            <td>${row.rejected_total}</td>
                            <td>${row.rejected_total_percentage}%</td>

                            <td>${production_date_from}</td>
                            <td>${production_date_to}</td>
                            <td>${hatch_date}</td>
                            <td>${qc_date}</td>

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