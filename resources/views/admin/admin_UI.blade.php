<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="/Images/BGC icon.ico">
    <link rel="stylesheet" href="/Css/admin-styles.css">

    @livewireStyles
</head>
<body>
    <div class="header">
        <img class="logo" src="/Images/BDL.png" alt="">
        <h2>DASHBOARD</h2>
        <div class="exit-icon" >
            <img src="/Images/Exit-Icon.png" alt="" onclick="window.location.href='/Html/main_module.html'">
        </div>
    </div>

    <div class="body-split">
        <div class="sidebar">
            <a href="#table1"><div></div><i class="fa-solid fa-table-cells-large"></i></a>
            <a href="#table2"><div></div><i class="fa-solid fa-clipboard-list"></i></a>
            <a href="#table3" class="active"><div></div><i class="fa-solid fa-clipboard-user"></i></a>
            <a href="{{ route('users.index') }}" {{ Route::currentRouteName() === 'users' ? 'class="active"' : '' }}><div></div><i class="fa-solid fa-users"></i></a>
        </div>

        <div class="form-entries">
            <div class="table" id="table1">
                <div class="table-header">
                    <h4>Admin Dashboard</h4>

                    <div class="table-action">
                        <div class="search-bar">
                            <input type="text" placeholder="Search...">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>

                        <select class="sort-btn">
                            <option value=""> Sort By</option>
                        </select>

                        <div class="table-icons">
                            <i class="fa-solid fa-print"></i>
                            <i class="fa-solid fa-rotate-right"></i>
                        </div>

                    </div>

                </div>
                <div class="table-body">
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

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>#93</td>
                                <td>09/12/25</td>
                                <td>09/12/25</td>
                                <td>30000</td>
                                <td>0</td>
                                <td>30000</td>
                                <td>30000</td>
                                <td>09/15/25</td>
                                <td>29000</td>
                                <td>Incubator A</td>
                                <td>09/20/25</td>
                                <td>28500</td>
                                <td>500</td>
                                <td>1.75%</td>
                                <td>28000</td>
                                <td>15000</td>
                                <td>53.57%</td>
                                <td>13000</td>
                                <td>46.43%</td>
                                <td>14000</td>
                                <td>50.00%</td>
                                <td>14000</td>
                                <td>50.00%</td>
                                <td>12000</td>
                                <td>42.86%</td>
                                <td>16000</td>
                                <td>57.14%</td>
                                <td>09/28/25</td>
                                <td>500</td>
                                <td>400</td>
                                <td>Hatcher B</td>
                                <td>10/02/25</td>
                                <td>300</td>
                                <td>27000</td>
                                <td>12000</td>
                                <td>15000</td>
                                <td>10/04/25</td>
                                <td>200</td>
                                <td>14800</td>
                                <td>14000</td>
                                <td>800</td>
                                <td>600</td>
                                <td>10</td>
                                <td>1.79%</td>
                                <td>500</td>
                                <td>1.11%</td>
                                <td>300</td>
                                <td>42.86%</td>
                                <td>12000</td>
                                <td>1.35%</td>
                                <td>200</td>
                                <td>1000</td>
                                <td>8</td>
                                <td>26000</td>
                                <td>92.86%</td>
                                <td>1000</td>
                                <td>7.14%</td>
                                <td>25000</td>
                                <td>Customer A</td>
                                <td>Customer B</td>
                                <td>Customer C</td>
                                <td>Customer D</td>
                                <td>Customer E</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>85%</td>
                                <td>John Doe</td>
                                <td>10/05/25</td>
                                <td>Updated</td>
                                <td class="datalist-actions">
                                    <i class="fa-regular fa-pen-to-square" id="edit-action"></i>
                                    <i class="fa-regular fa-trash-can" id="delete-action"></i>
                                    <i class="fa-solid fa-print" id="print-action"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>#93</td>
                                <td>09/12/25</td>
                                <td>09/12/25</td>
                                <td>30000</td>
                                <td>0</td>
                                <td>30000</td>
                                <td>30000</td>
                                <td>09/15/25</td>
                                <td>29000</td>
                                <td>Incubator A</td>
                                <td>09/20/25</td>
                                <td>28500</td>
                                <td>500</td>
                                <td>1.75%</td>
                                <td>28000</td>
                                <td>15000</td>
                                <td>53.57%</td>
                                <td>13000</td>
                                <td>46.43%</td>
                                <td>14000</td>
                                <td>50.00%</td>
                                <td>14000</td>
                                <td>50.00%</td>
                                <td>12000</td>
                                <td>42.86%</td>
                                <td>16000</td>
                                <td>57.14%</td>
                                <td>09/28/25</td>
                                <td>500</td>
                                <td>400</td>
                                <td>Hatcher B</td>
                                <td>10/02/25</td>
                                <td>300</td>
                                <td>27000</td>
                                <td>12000</td>
                                <td>15000</td>
                                <td>10/04/25</td>
                                <td>200</td>
                                <td>14800</td>
                                <td>14000</td>
                                <td>800</td>
                                <td>600</td>
                                <td>10</td>
                                <td>1.79%</td>
                                <td>500</td>
                                <td>1.11%</td>
                                <td>300</td>
                                <td>42.86%</td>
                                <td>12000</td>
                                <td>1.35%</td>
                                <td>200</td>
                                <td>1000</td>
                                <td>8</td>
                                <td>26000</td>
                                <td>92.86%</td>
                                <td>1000</td>
                                <td>7.14%</td>
                                <td>25000</td>
                                <td>Customer A</td>
                                <td>Customer B</td>
                                <td>Customer C</td>
                                <td>Customer D</td>
                                <td>Customer E</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>85%</td>
                                <td>John Doe</td>
                                <td>10/05/25</td>
                                <td>Updated</td>
                                <td class="datalist-actions">
                                    <i class="fa-regular fa-pen-to-square" id="edit-action"></i>
                                    <i class="fa-regular fa-trash-can" id="delete-action"></i>
                                    <i class="fa-solid fa-print" id="print-action"></i>
                                </td>
                            </tr>

                        </tbody>

                    </table>
                </div>
                <div class="table-footer">
                    <div class="pagination">
                        <a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#"><i class="fa-solid fa-caret-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="table" id="table2">
                <div class="table-header">
                    <h4>Audit Trail</h4>

                    <div class="table-action">
                        <div class="search-bar">
                            <input type="text" placeholder="Search...">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>

                        <select class="sort-btn">
                            <option value=""> Sort By</option>
                        </select>

                        <div class="table-icons">
                            <i class="fa-solid fa-print"></i>
                            <i class="fa-solid fa-rotate-right"></i>
                        </div>

                    </div>

                </div>
                <div class="table-body">
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

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>#93</td>
                                <td>09/12/25</td>
                                <td>09/12/25</td>
                                <td>30000</td>
                                <td>0</td>
                                <td>30000</td>
                                <td>30000</td>
                                <td>09/15/25</td>
                                <td>29000</td>
                                <td>Incubator A</td>
                                <td>09/20/25</td>
                                <td>28500</td>
                                <td>500</td>
                                <td>1.75%</td>
                                <td>28000</td>
                                <td>15000</td>
                                <td>53.57%</td>
                                <td>13000</td>
                                <td>46.43%</td>
                                <td>14000</td>
                                <td>50.00%</td>
                                <td>14000</td>
                                <td>50.00%</td>
                                <td>12000</td>
                                <td>42.86%</td>
                                <td>16000</td>
                                <td>57.14%</td>
                                <td>09/28/25</td>
                                <td>500</td>
                                <td>400</td>
                                <td>Hatcher B</td>
                                <td>10/02/25</td>
                                <td>300</td>
                                <td>27000</td>
                                <td>12000</td>
                                <td>15000</td>
                                <td>10/04/25</td>
                                <td>200</td>
                                <td>14800</td>
                                <td>14000</td>
                                <td>800</td>
                                <td>600</td>
                                <td>10</td>
                                <td>1.79%</td>
                                <td>500</td>
                                <td>1.11%</td>
                                <td>300</td>
                                <td>42.86%</td>
                                <td>12000</td>
                                <td>1.35%</td>
                                <td>200</td>
                                <td>1000</td>
                                <td>8</td>
                                <td>26000</td>
                                <td>92.86%</td>
                                <td>1000</td>
                                <td>7.14%</td>
                                <td>25000</td>
                                <td>Customer A</td>
                                <td>Customer B</td>
                                <td>Customer C</td>
                                <td>Customer D</td>
                                <td>Customer E</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>85%</td>
                                <td>John Doe</td>
                                <td>10/05/25</td>
                                <td>Updated</td>
                                <td class="datalist-actions">
                                    <i class="fa-regular fa-pen-to-square" id="edit-action"></i>
                                    <i class="fa-regular fa-trash-can" id="delete-action"></i>
                                    <i class="fa-solid fa-print" id="print-action"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>#93</td>
                                <td>09/12/25</td>
                                <td>09/12/25</td>
                                <td>30000</td>
                                <td>0</td>
                                <td>30000</td>
                                <td>30000</td>
                                <td>09/15/25</td>
                                <td>29000</td>
                                <td>Incubator A</td>
                                <td>09/20/25</td>
                                <td>28500</td>
                                <td>500</td>
                                <td>1.75%</td>
                                <td>28000</td>
                                <td>15000</td>
                                <td>53.57%</td>
                                <td>13000</td>
                                <td>46.43%</td>
                                <td>14000</td>
                                <td>50.00%</td>
                                <td>14000</td>
                                <td>50.00%</td>
                                <td>12000</td>
                                <td>42.86%</td>
                                <td>16000</td>
                                <td>57.14%</td>
                                <td>09/28/25</td>
                                <td>500</td>
                                <td>400</td>
                                <td>Hatcher B</td>
                                <td>10/02/25</td>
                                <td>300</td>
                                <td>27000</td>
                                <td>12000</td>
                                <td>15000</td>
                                <td>10/04/25</td>
                                <td>200</td>
                                <td>14800</td>
                                <td>14000</td>
                                <td>800</td>
                                <td>600</td>
                                <td>10</td>
                                <td>1.79%</td>
                                <td>500</td>
                                <td>1.11%</td>
                                <td>300</td>
                                <td>42.86%</td>
                                <td>12000</td>
                                <td>1.35%</td>
                                <td>200</td>
                                <td>1000</td>
                                <td>8</td>
                                <td>26000</td>
                                <td>92.86%</td>
                                <td>1000</td>
                                <td>7.14%</td>
                                <td>25000</td>
                                <td>Customer A</td>
                                <td>Customer B</td>
                                <td>Customer C</td>
                                <td>Customer D</td>
                                <td>Customer E</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>85%</td>
                                <td>John Doe</td>
                                <td>10/05/25</td>
                                <td>Updated</td>
                                <td class="datalist-actions">
                                    <i class="fa-regular fa-pen-to-square" id="edit-action"></i>
                                    <i class="fa-regular fa-trash-can" id="delete-action"></i>
                                    <i class="fa-solid fa-print" id="print-action"></i>
                                </td>
                            </tr>

                        </tbody>

                    </table>
                </div>
                <div class="table-footer">
                    <div class="pagination">
                        <a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#"><i class="fa-solid fa-caret-right"></i></a>
                    </div>
                </div>
            </div>

            @yield('user_logs_content')

            {{-- @livewire('users.grant-access') --}}
            {{-- , ['id' => $user_id] --}}

            @yield('user_content')


        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebarLinks = document.querySelectorAll(".sidebar a");
            const tables = document.querySelectorAll(".table");

            // Click event for sidebar links
            sidebarLinks.forEach(link => {
                link.addEventListener("click", function (event) {
                    event.preventDefault(); // Prevent default anchor behavior

                    const targetTable = document.querySelector(this.getAttribute("href"));
                    activateSection(targetTable);
                });
            });

            // Function to handle sidebar and table activation
            function activateSection(targetTable) {
                // Remove 'active' class from all sidebar links and tables
                sidebarLinks.forEach(link => link.classList.remove("active"));
                tables.forEach(table => table.classList.remove("active"));

                if (targetTable) {
                    // Activate corresponding sidebar link
                    const targetSidebarLink = document.querySelector(`.sidebar a[href="#${targetTable.id}"]`);
                    if (targetSidebarLink) targetSidebarLink.classList.add("active");

                    // Activate target table
                    targetTable.classList.add("active");
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('scripts_access_logs')
    @yield('scriptss')
    @stack('scripts')
    @stack('scriptsis')


</body>
</html>
