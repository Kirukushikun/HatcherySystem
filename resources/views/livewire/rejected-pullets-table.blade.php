<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>PS No.</th>
            <th>Production Date</th>
            <th>Set Eggs Quantity</th>
            <th>Incubator No.</th>
            <th>Hatcher No.</th>
            
            <th>One Eye closed</th>
            <th>One Eye closed %</th>
            <th>No Eyes</th>
            <th>No Eyes %</th>
            <th>Small Eyes</th>
            <th>Small Eyes %</th>
            <th>Large Eyes</th>
            <th>Large Eyes %</th>
            <th>Unhealed Navel</th>
            <th>Unhealed Navel %</th>
            <th>Crossed Beak</th>
            <th>Crossed Beak %</th>
            <th>Small Chick</th>
            <th>Small Chick %</th>
            <th>Weak Chick</th>
            <th>Weak Chick %</th>
            <th>Black Bottons</th>
            <th>Black Bottons %</th>
            <th>String Navel</th>
            <th>String Navel %</th>
            <th>Bloated</th>
            <th>Bloated %</th>

            <th>Pullout Date</th>
            <th>Hatch Date</th>
            <th>QC Date</th>
            <th>Rejected Total</th>
            <th>Rejected Total Percentage</th>
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
        fetch(`/fetch-rejected-pullets-data?page=${currentPage}&search=${searchQuery}&sort_by=${sortBy}&sort_order=${sortOrder}`)
            .then(response => response.json())
            .then(data => {
                totalPages = data.last_page;
                const tableBody = document.getElementById('table-body');
                tableBody.innerHTML = '';
                data.data.forEach(row => {
                    let production_date = new Date(row.production_date).toLocaleDateString();
                    let pullout_date = new Date(row.pullout_date).toLocaleDateString();
                    let hatch_date = new Date(row.hatch_date).toLocaleDateString();
                    let qc_date = new Date(row.qc_date).toLocaleDateString();

                    // Parse rejected_hatch_data JSON
                    let rejectedPulletsData = {
                        singkit_mata: { qty: 0, percentage: 0 },
                        wala_mata: { qty: 0, percentage: 0 },
                        maliit_mata: { qty: 0, percentage: 0 },
                        malaki_mata: { qty: 0, percentage: 0 },
                        unhealed_navel: { qty: 0, percentage: 0 },
                        cross_beak: { qty: 0, percentage: 0 },
                        small_chick: { qty: 0, percentage: 0 },
                        weak_chick: { qty: 0, percentage: 0 },
                        black_bottons: { qty: 0, percentage: 0 },
                        string_navel: { qty: 0, percentage: 0 },
                        bloated: { qty: 0, percentage: 0 }
                    };

                    try {
                        let parsedData = JSON.parse(row.rejected_pullets_data);
                        rejectedPulletsData = { ...rejectedPulletsData, ...parsedData }; // Merge with defaults
                    } catch (error) {
                        console.error("Error parsing Rejected Pullets Data:", error);
                    }

                    tableBody.innerHTML += `
                        <tr id="row-${row.id}">
                            <td>${row.id}</td>
                            <td>${row.ps_no}</td>
                            <td>${production_date}</td>
                            <td>${row.set_eggs_qty}</td>
                            <td>${row.incubator_no}</td>
                            <td>${row.hatcher_no}</td>

                            <td>${rejectedPulletsData.singkit_mata.qty}</td>
                            <td>${rejectedPulletsData.singkit_mata.percentage}</td>
                            <td>${rejectedPulletsData.wala_mata.qty}</td>
                            <td>${rejectedPulletsData.wala_mata.percentage}</td>
                            <td>${rejectedPulletsData.maliit_mata.qty}</td>
                            <td>${rejectedPulletsData.maliit_mata.percentage}</td>
                            <td>${rejectedPulletsData.malaki_mata.qty}</td>
                            <td>${rejectedPulletsData.malaki_mata.percentage}</td>
                            <td>${rejectedPulletsData.unhealed_navel.qty}</td>
                            <td>${rejectedPulletsData.unhealed_navel.percentage}</td>
                            <td>${rejectedPulletsData.cross_beak.qty}</td>
                            <td>${rejectedPulletsData.cross_beak.percentage}</td>
                            <td>${rejectedPulletsData.small_chick.qty}</td>
                            <td>${rejectedPulletsData.small_chick.percentage}</td>
                            <td>${rejectedPulletsData.weak_chick.qty}</td>
                            <td>${rejectedPulletsData.weak_chick.percentage}</td>
                            <td>${rejectedPulletsData.black_bottons.qty}</td>
                            <td>${rejectedPulletsData.black_bottons.percentage}</td>
                            <td>${rejectedPulletsData.string_navel.qty}</td>
                            <td>${rejectedPulletsData.string_navel.percentage}</td>
                            <td>${rejectedPulletsData.bloated.qty}</td>
                            <td>${rejectedPulletsData.bloated.percentage}</td>

                            <td>${pullout_date}</td>
                            <td>${hatch_date}</td>
                            <td>${qc_date}</td>

                            <td>${row.rejected_total}</td>
                            <td>${row.rejected_total_percentage}</td>
                            <td>Iverson Guno</td>

                            <td class="datalist-actions">
                                <i class="fa-regular fa-pen-to-square load" id="edit-action" onclick="showModal('edit', ${row.id})"></i>
                                <i class="fa-regular fa-trash-can" id="delete-action" onclick="showModal('delete', ${row.id})"></i>
                            </td>
                        </tr>
                    `;
                });
                updatePagination();
                loadingScreen();
            })
            .catch(error => console.log("Error fetching data", error));
    }

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
    function refreshTable() {
        const tableBody = document.getElementById('table-body');
        tableBody.innerHTML = '';

        skeletonLoader();
        
        setTimeout(() => {
            loadData();
        }, 1000);

        updatePagination();
    }

</script>