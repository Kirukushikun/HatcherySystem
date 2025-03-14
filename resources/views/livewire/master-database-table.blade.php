<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Egg Collection</th>  

            <th>Storage Classification</th>  
            <th>Storage Retrieval</th>  
            <th>Setter Entry</th>  
            <th>Candling Entry</th>  
            <th>Eggshell Temperature Check</th>  
            <th>Hatcher Retrieval</th>  
            <th>Chick Sexing</th>  
            <th>QC/QA Inspection</th>  
            <th>Dispatch Entry</th>  
            <th>Hatch Forecasting</th>

            <th>Encoded/Modified By</th>
            <th>Date Encoded/Modified</th>
            <th>Actions</th>
        </tr>
    </thead>
    
    <tbody id="table-body" class="table-body-data">
    </tbody>
    
</table>


<script>
    let currentPage = 1;
    let totalPages = 1;
    let searchQuery = "";
    let sortBy = "created_at";
    let sortOrder = "desc";

    document.addEventListener('DOMContentLoaded', () => {
        loadData();
    })
    
    function loadData() {
        
        skeletonLoader();

        fetch(`/fetch-master-database-data`)
            .then(response => response.json())
            .then(data => {
                const tableBody = document.querySelector(".table-body-data");
                tableBody.innerHTML = ""; // Clear table before inserting new data

                data.forEach(row => {
                    const tr = document.createElement("tr");

                    // Create Batch No column
                    const batchNoTd = document.createElement("td");
                    batchNoTd.textContent = row.batch_no;
                    tr.appendChild(batchNoTd);

                    // Define the step order manually (Swap 11 and 12)
                    const stepOrder = [2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 11]; 

                    // Loop through steps in the specified order
                    stepOrder.forEach(step => {
                        const td = document.createElement("td");
                        const p = document.createElement("p");

                        if (row[step] === "Done") {
                            p.innerHTML = 'Done <i class="fa-solid fa-circle-check"></i>';
                            p.classList.add("done"); // Add class "Done"
                        } else {
                            p.innerHTML = 'Pending <i class="fa-solid fa-circle-xmark"></i>'; // Default to "Pending"
                            p.classList.add("pending");
                        }

                        td.appendChild(p);
                        tr.appendChild(td);
                    });

                    // Create Encoded By column
                    const encodedByTd = document.createElement("td");
                    encodedByTd.textContent = "IT Admin";
                    tr.appendChild(encodedByTd);

                    // Create Date Encoded column
                    const dateEncodedTd = document.createElement("td");
                    dateEncodedTd.textContent = row.date_encoded;
                    tr.appendChild(dateEncodedTd);

                    // Create Action column
                    const actionTd = document.createElement("td");
                    actionTd.classList.add("datalist-actions");
                    actionTd.innerHTML = `
                        <i class="fa-solid fa-eye" id="edit-action" onclick="showModal('view', ${row.batch_no})"></i>
                        <i class="fa-regular fa-trash-can" id="delete-action" onclick="showModal('delete', ${row.batch_no})"></i>
                        <i class="fa-solid fa-print" id="print-action"></i>
                    `;
                    tr.appendChild(actionTd);

                    tableBody.appendChild(tr); // Append row to table
                });
            })
            .catch(error => console.error("Error fetching data:", error));
    }

    // Helper function to create a table cell
    function createCell(content) {
        const cell = document.createElement("td");
        cell.textContent = content;
        return cell;
    }

    function skeletonLoader() {
        const tableBody = document.getElementById('table-body');
        const existingRowCount = tableBody.querySelectorAll("tr").length; // Count existing rows
        const skeletonRowCount = existingRowCount > 0 ? existingRowCount : 2; // Use existing rows or default to 2

        tableBody.innerHTML = ""; // Clear table before adding skeletons

        for (let i = 0; i < skeletonRowCount; i++) {
            const row = document.createElement("tr");

            for (let j = 0; j < 15; j++) { // Assuming 15 columns
                let ranWidth = Math.floor(Math.random() * (100 - 50 + 1) + 50) + "%"; // Random width
                const cell = document.createElement("td");
                const skeleton = document.createElement("div");
                skeleton.classList.add("skeleton");
                skeleton.style.width = ranWidth;
                cell.appendChild(skeleton);
                row.appendChild(cell);
            }

            tableBody.appendChild(row);
        }
    }



</script>