<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>PS no.</th>
            <th>Production Date (From)</th>
            <th>Production Date (To)</th>
            <th>Collected QTY</th>
            <th>Non Settable Eggs QTY</th>
            <th>Storage Settable Eggs</th>
            <th>Storage Remaining Balance</th>
            <th>Pullout Date</th>
            <th>Pullout Settable Eggs QTY</th>
            <th>Incubator</th>
            <th>Day 10 Candling Date</th>
            <th>Day 10 Candling Eggs QTY</th>
            <th>Day 10 Breakout QTY</th>
            <th>Day 10 Breakout %</th>
            <th>Day 10 Incubated Eggs</th>
            <th>Top 37.8 UP QTY</th>
            <th>Top 37.8 UP%</th>
            <th>Top 37.7 BELOW QTY</th>
            <th>Top 37.7 BELOW %</th>
            <th>Mid 37.8 UP QTY</th>
            <th>Mid 37.8 %</th>
            <th>Mid 37.7 BELOW QTY</th>
            <th>Mid 37.7 BELOW %</th>
            <th>Low 37.8 UP QTY</th>
            <th>Low 37.8 UP %</th>
            <th>Low 37.7 BELOW QTY</th>
            <th>Low 37.7 BELOW %</th>
            <th>Day 18.5 Candling Date</th>
            <th>Day 18.5 Infertile QTY</th>
            <th>Day 18.5 Embryonic QTY</th>
            <th>Hatcher</th>
            <th>Hatch Date</th>
            <th>Rejected Hatch QTY</th>
            <th>Good Hatch QTY</th>
            <th>Cockerels QTY</th>
            <th>DOP QTY</th>
            <th>QC Date</th>
            <th>Rejected DOP QTY</th>
            <th>Good DOP QTY</th>
            <th>Prime QTY</th>
            <th>JR Prime QTY</th>
            <th># of Boxes</th>
            <th>Infertile %</th>
            <th>Infertile EST QTY</th>
            <th>Rejected Hatch %</th>
            <th>Rejected Hatch EST QTY</th>
            <th>Cockerels %</th>
            <th>Cockerels EST QTY</th>
            <th>Rejected DOP %</th>
            <th>Rejected DOP EST QTY</th>
            <th>Total Rejects QTY</th>
            <th>Projected # of Boxes</th>
            <th>Prime Set QTY</th>
            <th>Prime Set %</th>
            <th>JP Set QTY</th>
            <th>JP Set %</th>
            <th>Prime Forecast QTY</th>
            <th>JP Forecast QTY</th>
            <th>Customer 1</th>
            <th>Customer 2</th>
            <th>Customer 3</th>
            <th>Customer 4</th>
            <th>Customer 5</th>
            <th>CUST 1 Prime QTY</th>
            <th>CUST 2 Prime QTY</th>
            <th>CUST 3 Prime QTY</th>
            <th>CUST 4 Prime QTY</th>
            <th>CUST 5 Prime QTY</th>
            <th>CUST 1 JR Prime QTY</th>
            <th>CUST 2 JR Prime QTY</th>
            <th>CUST 3 JR Prime QTY</th>
            <th>CUST 4 JR Prime QTY</th>
            <th>CUST 5 JR Prime QTY</th>
            <th>Projected # of Boxes %</th>
            <th>Encoded/Modified By</th>
            <th>Date Encoded/Modified</th>
            <th>Action Done</th>
            <th>Actions</th>
        </tr>
    </thead>
    
    <tbody id="table-body" class="table-body-data">
        <tr>

            <td class="datalist-actions">
                <i class="fa-regular fa-pen-to-square" id="edit-action"></i>
                <i class="fa-regular fa-trash-can" id="delete-action"></i>
                <i class="fa-solid fa-print" id="print-action"></i>
            </td>
        </tr>
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
        fetch(`/fetch-master-database-data`)
        .then(response => response.json())
        .then(({ data }) => {
            const tableBody = document.querySelector(".table-body-data");
            tableBody.innerHTML = ""; // Clear table

            data.forEach(({ batch_no, processes }) => {
                const row = document.createElement("tr");

                // Create a cell for the batch number
                const batchCell = document.createElement("td");
                batchCell.textContent = batch_no;
                row.appendChild(batchCell);

                // Process each process group in the batch
                processes.forEach(process => {
                    // Ensure we handle cases where process may be empty
                    const [groupName, groupData] = Object.entries(process)[0] || ["unknown", {}];

                    if (groupName === "collected_eggs") {
                        // Define the correct order for keys
                        const keyOrder = ["ps_no", "production_date_from", "production_date_to", "collected_qty"];

                        keyOrder.forEach(key => {
                            row.appendChild(createCell(groupData[key] ?? "N/A")); // Handle missing keys
                        });

                    } else if (groupName === "classification_for_storage") {
                        // Define the correct order for keys
                        const keyOrder = ["non_settable_eggs", "settable_eggs", "remaining_balance"];

                        keyOrder.forEach(key => {
                            row.appendChild(createCell(groupData[key] ?? "N/A")); // Handle missing keys
                        });

                    } else {
                        row.appendChild(createCell(groupData || "N/A"));
                    }
                });

                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching batch data:', error));
    }

    // Helper function to create a table cell
    function createCell(content) {
        const cell = document.createElement("td");
        cell.textContent = content;
        return cell;
    }


</script>