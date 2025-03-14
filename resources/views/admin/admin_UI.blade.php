@include('components.modal-notification-loader')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="/Images/BGC icon.ico">
    <link rel="stylesheet" href="/css/admin-styles.css">
    <link rel="stylesheet" href="/css/modal-notification-loader.css">
    @livewireStyles

    <!-- Crucial Part on every forms -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Crucial Part on every forms/ -->   

    <style>
        #table1{
            background-color: transparent;

            border-radius: 10px;
            padding: 0;

            /* display: flex;
            flex-direction: column;
            gap: 30px; */
        }
        .col-2{
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .table-form{
            display: flex;
            flex-direction: column;
            gap: 20px;
            position: relative;

            background-color: white;
            border-radius: 10px;
            padding: 25px 25px 90px;
        }
        .table-form .input-container.row{
            display: flex;
            flex-direction: row;
            gap: 10px;
        }

        .table-form .input-container.column{
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .table-form .input-container label{
            position: relative;
        }
        .table-form .input-container label span{
            position: absolute;
            left: 10px;
            bottom: -20px;
            color: #ea4435d7;
            font-weight: 600;
            font-size: 12px;
            background-color: white;
        }

        .table-form .input-container input{
            background-color: #F6F4F1;
            border: solid 2px #e2e2e2;
            border-radius: 5px;
            padding: 8px 12px;

            font-size: 15px;
            font-weight: 300;

            width: 100%;
            outline: none;
        }
        .table-form .input-container select{
            background-color: #F6F4F1;
            border: solid 2px #e2e2e2;
            border-radius: 5px;
            padding: 8px 12px;

            font-size: 15px;
            font-weight: 300;

            width: 100%;
        }

        .table-content{
            display: flex;
            flex-direction: column;
            gap: 30px;

            background-color: white;
            border-radius: 10px;
            padding: 25px 30px;
            background-color: white;

            height: 100%;
        }

        /* Audit Modal */

        #audit-modal .modal-content{
            background-color:rgb(255, 255, 255);
        }

        #audit-modal .modal-content .audit-table{
            border-collapse: collapse;
        }

        #audit-modal .modal-content tbody {
            border: solid 1px rgb(210, 210, 210);
        }

        #audit-modal .modal-content th {
            background-color: #EC8B18;
            padding: 10px;
            padding-left: 20px;
            padding-right: 20px;
            text-align: start;
        }

        #audit-modal .modal-content th:first-child{
            border-radius: 10px 0 0 0;
        }
        #audit-modal .modal-content th:last-child{
            border-radius: 0 10px 0 0;
        }

        #audit-modal .modal-content tr {
            border: none;
        }
        #audit-modal .modal-content td {
            text-align: start;
            padding: 3px;
            padding-left: 20px;
            padding-right: 20px;
            border-left: solid 1px rgb(210, 210, 210);
            border-right: solid 1px rgb(210, 210, 210);
        }   
        /* ----------- */
        
    </style>
</head>
<body>

    @yield('modal-notification-loader')

    <div class="header">
        <img class="logo" src="/Images/BDL.png" alt="">
        <h2>ADMIN DASHBOARD</h2>
        <div class="exit-icon" >
            <img src="/Images/Exit-Icon.png" alt="" onclick="window.location.href='/home'">
        </div>
    </div>

    <div class="body-split">
        <div class="sidebar">
            <a href="#table1" class="active"><div></div><i class="fa-solid fa-table-cells-large"></i></a>
            <a href="#table2" class=""><div></div><i class="fa-solid fa-clipboard-list"></i></a>
            <a href="#table3" class=""><div></div><i class="fa-solid fa-clipboard-user"></i></a>
            <a href="#table4" class=""><div></div><i class="fa-solid fa-users"></i></a>
        </div>

        <div class="form-entries">

            <!-- Maintenance Value -->
            <div class="table active" id="table1">
                <form class="body">
                    @csrf
                    <div class="table-form">
                        <div class="form-header">
                            <h4>Add Maintenance Value</h4>
                        </div>
                        <div class="form-input col-2">  
                            <div class="input-container column">
                                <label for="data_category">Dynamic Fields<span></span></label>
                                <select name="data_category" id="data_category">
                                    <option value="" selected></option>
                                    <option value="ps_no" {{ session('form_data.data_category', '') == 'ps_no' ? 'selected' : ''}}>PS No.</option>
                                    <option value="hatcher_no" {{ session('form_data.data_category', '') == 'hatcher_no' ? 'selected' : ''}}>Hatcher No.</option>
                                    <option value="house_no" {{ session('form_data.data_category', '') == 'house_no' ? 'selected' : ''}}>House No.</option>
                                    <option value="incubator_no" {{ session('form_data.data_category', '') == 'incubator_no' ? 'selected' : ''}}>Incubator No.</option>
                                </select>
                            </div>
                            <div class="input-container column">
                                <label for="data_value">Value<span></span></label>
                                <input type="text" name="data_value" id="data_value" value="" placeholder="0">
                            </div>
                        </div>
                        <div class="form-action">
                            <button class="save-btn" type="submit">Save</button>
                            <button class="reset-btn" type="reset">Reset</button>
                        </div>
                    </div>
                </form>


                <div class="table-content">
                    <div class="table-header">
                        <h4>Maintenance Value</h4>
                        <div class="table-action">
                            <div class="search-bar" id="search-bar-maintenance">
                                <input type="text" placeholder="Search...">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
            
                            <select class="sort-btn" name="sort_by" id="sort-by-maintenance">
                                <option value="created_at_desc">Sort By: Date (Newest)</option>
                                <option value="created_at_asc">Sort By: Date (Oldest)</option>
                                <option value="data_category_asc">Sort By: Category</option>
                            </select>
            
                            <div class="table-icons">
                                <i class="fa-solid fa-rotate-right" onclick="refreshTableMaintenance()"></i>
                            </div>
                        </div>
                    </div>
                    <div class="table-body">
                        <livewire:maintenance-value-table />
                    </div>
                    <div class="table-footer">
                        <div class="pagination" id="pagination-maintenance">
                            <a href="#" class="active">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#"><i class="fa-solid fa-caret-right"></i></a>
                        </div>
                    </div>                    
                </div>
            </div>

            <!-- Audit Trail -->
            <div class="table" id="table2">
                <div class="table-header">
                <div id="audit-modal" class="modal"></div>
                    <h4>Audit Trail</h4>
                    <div class="table-action">
                        <div class="search-bar" id="search-bar-audit">
                            <input type="text" placeholder="Search...">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>

                        <select class="sort-btn" name="sort_by" id="sort-by-audit">
                            <option value="created_at_desc">Sort By: Date (Newest)</option>
                            <option value="created_at_asc">Sort By: Date (Oldest)</option>
                            <option value="table_asc">Sort By: Table Name</option>
                            <option value="action_asc">Sort By: Action</option>
                        </select>

                        <div class="table-icons">
                            <i class="fa-solid fa-rotate-right" onclick="refreshTableAudit()"></i>
                        </div>

                    </div>

                </div>
                <div class="table-body">
                    <livewire:audit-trail-table />
                </div>
                <div class="table-footer">
                    <div class="pagination" id="pagination-audit">
                        <a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#"><i class="fa-solid fa-caret-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Access Logs -->
            <div class="table" id="table3">
                <div class="table-header">
                    <h4>Access Logs</h4>

                    <div class="table-action">
                        <div class="search-bar">
                            <input type="text" id="searchInput" placeholder="Search...">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>

                        <div class="table-icons">
                            <i class="fa-solid fa-print"></i>
                        </div>
                    </div>
                </div>

                <div class="table-body" style="position: relative;">

                    <table>
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">User ID</th>                                
                                <th class="text-center">Name</th>
                                <th class="text-center">Date / Time</th>
                            </tr>
                        </thead>
                        <tbody id="accessLogs">
                            <!-- Skeleton Loader rows while fetching data -->
                            @for ($i = 0; $i < 10; $i++)
                                <tr class="skeleton-row">
                                    <td><div class="skeleton-loader" style="width: {{ rand(30, 70) }}%;"></div></td>
                                    <td><div class="skeleton-loader" style="width: {{ rand(50, 90) }}%;"></div></td>
                                    <td><div class="skeleton-loader" style="width: {{ rand(40, 80) }}%;"></div></td>
                                    <td><div class="skeleton-loader" style="width: {{ rand(60, 100) }}%;"></div></td>
                                </tr>
                            @endfor
                            <!-- Additional skeleton rows if needed -->
                        </tbody>
                    </table>
                </div>
                <!-- Loader (Initially hidden) -->
                <div class="loading-screen">
                    <div class="loader"></div>
                </div>

                <div class="table-footer">
                    <div class="pagination" id="accessLogsPagination">
                    </div>
                </div>
            </div>

            <!-- Users -->
            <div class="table" id="table4">
                <div class="table-header">
                    <h4>Users</h4>

                    <div class="table-action">
                        <div class="search-bar">
                            <input type="text" placeholder="Search..." />
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>

                        <select class="sort-btn">
                            <option value="">Sort By</option>
                        </select>

                        <div class="table-icons">
                            <i class="fa-solid fa-print"></i>
                            <i class="fa-solid fa-rotate-right"></i>
                        </div>
                    </div>
                </div>
                <div class="table-body" style="position: relative">
                    <table id="users">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">First Name</th>
                                <th class="text-center">Last Name</th>
                                <th class="text-center">System Access</th>
                                <th class="text-center">Role</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="userTable">
                            <!-- Skeleton Loader rows while fetching data -->
                            @for ($i = 0; $i < 10; $i++)
                            <tr class="skeleton-row">
                                <td><div class="skeleton-loader" style="width: {{ rand(30, 70) }}%;"></div></td>
                                <td><div class="skeleton-loader" style="width: {{ rand(50, 90) }}%;"></div></td>
                                <td><div class="skeleton-loader" style="width: {{ rand(40, 80) }}%;"></div></td>
                                <td><div class="skeleton-loader" style="width: {{ rand(60, 100) }}%;"></div></td>
                                <td><div class="skeleton-loader" style="width: {{ rand(30, 70) }}%;"></div></td>
                                <td><div class="skeleton-loader" style="width: {{ rand(50, 90) }}%;"></div></td>
                            </tr>
                            @endfor
                            <!-- Additional skeleton rows if needed -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Loader (Initially hidden) -->
            <div class="loading-screen">
                <div class="loader"></div>
            </div>

            <div class="table-footer">
                <div class="pagination" id="userPagination">
                </div>
            </div>
        </div>

        </div>
    </div>

    <script>

    let currentPage = 1;
    let totalPages = 1;
    let searchQuery = "";
    let sortBy = "created_at";
    let sortOrder = "desc";

    document.addEventListener("DOMContentLoaded", function () {
    const sidebarLinks = document.querySelectorAll(".sidebar a");
    const tables = document.querySelectorAll(".table");

    // Retrieve the last active tab from local storage
    const savedTab = localStorage.getItem("activeTab");
    if (savedTab) {
        activateSection(document.querySelector(savedTab));
    } else {
        activateSection(document.querySelector(".table.active")); // Default to first section
    }

    // Click event for sidebar links
    sidebarLinks.forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            const targetTable = document.querySelector(this.getAttribute("href"));
            activateSection(targetTable);

            // Save the active tab in local storage
            localStorage.setItem("activeTab", this.getAttribute("href"));
        });
    });

    // Function to handle sidebar and table activation
    function activateSection(targetTable) {
        if (!targetTable) return;

        // Remove 'active' class from all sidebar links and tables
        sidebarLinks.forEach(link => link.classList.remove("active"));
        tables.forEach(table => table.classList.remove("active"));

        // Activate the selected sidebar link and table
        const targetSidebarLink = document.querySelector(`.sidebar a[href="#${targetTable.id}"]`);
        if (targetSidebarLink) targetSidebarLink.classList.add("active");
        targetTable.classList.add("active");
    }
    });

    </script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('scripts_access_logs')
    @yield('scriptss')
    @stack('scripts')
    @stack('scriptsis')

    <script src="{{ asset('js/maintenance-values.js') }}" defer></script>
    <script src="{{ asset('js/audit.js') }}" defer></script>
    <script src="{{ asset('js/user.js') }}" defer></script>
    <script src="{{ asset('js/user-logs.js') }}" defer></script>
    <script src="{{ asset('js/loading-screen.js') }}" defer></script>
    <script src="{{ asset('js/push-notification.js') }}" defer></script>


</body>
</html>
