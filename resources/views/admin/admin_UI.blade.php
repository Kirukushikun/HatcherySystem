@include('components.modal-notification-loader')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="/Images/BGC icon.ico">
    <link rel="stylesheet" href="/css/admin-styles.css">
    <link rel="stylesheet" href="/css/modal-notification-loader.css">

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
            <a href="#table1" class=""><div></div><i class="fa-solid fa-table-cells-large"></i></a>
            <a href="#table2" class="active"><div></div><i class="fa-solid fa-clipboard-list"></i></a>
            <a href="#table3"><div></div><i class="fa-solid fa-clipboard-user"></i></a>
            <a href="#table4"><div></div><i class="fa-solid fa-users"></i></a>
        </div>

        <div class="form-entries">

            <div class="table" id="table1">
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

            <div class="table active" id="table2">
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

    <script src="{{ asset('js/maintenance-values.js') }}" defer></script>
    <script src="{{asset('js/audit.js')}}" defer></script>
    <script src="{{asset('js/loading-screen.js')}}" defer></script>
    <script src="{{asset('js/push-notification.js')}}" defer></script>

</body>
</html>