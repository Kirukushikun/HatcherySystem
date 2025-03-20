@extends('admin.admin_UI')

@section('title')
    {{ __('Users List') }}
@endsection

@section('user_content')
<div class="table" id="table4">
    <div class="table-header">
        <h4>Users</h4>

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
    <div class="table-body" style="position: relative;">
        <table id="users">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">FIRST NAME</th>
                    <th class="text-center">LAST NAME</th>
                    <th class="text-center">SYSTEM ACCESS</th>
                    <th class="text-center">ROLE</th>
                    <th style="text-align: center">ACTION</th>
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
    <!-- Loader (Initially hidden) -->
    <div class="loading-screen">
        <div class="loader"></div>
    </div>

    <div class="table-footer">
        <div class="pagination" id="userPagination">
        </div>
    </div>
</div>
@endsection

@section('scriptss')
    <script>
        //sweetalert2
        // swal.fire({
        //     icon: 'success',
        //     title: 'Success',
        //     text: 'Data has been fetched successfully.',
        // })

        document.addEventListener("DOMContentLoaded", function () {
            let currentPage = 1;

            function fetchUsers(page = 1) {
                let tableBody = document.getElementById('userTable');
                let paginationContainer = document.querySelector('#userPagination');

                // if (!Array.isArray(data.data)) {
                //     data.data = Object.values(data.data);
                // }

                // Show skeleton loaders for the table
                tableBody.innerHTML = "";
                for (let i = 0; i < 10; i++) {
                    tableBody.innerHTML += `
                        <tr class="skeleton-row">
                            <td><div class="skeleton-loader" style="width: ${Math.floor(Math.random() * 40) + 30}%;"></div></td>
                            <td><div class="skeleton-loader" style="width: ${Math.floor(Math.random() * 50) + 40}%;"></div></td>
                            <td><div class="skeleton-loader" style="width: ${Math.floor(Math.random() * 50) + 40}%;"></div></td>
                            <td><div class="skeleton-loader" style="width: ${Math.floor(Math.random() * 50) + 40}%;"></div></td>
                            <td><div class="skeleton-loader" style="width: ${Math.floor(Math.random() * 50) + 40}%;"></div></td>
                            <td><div class="skeleton-loader" style="width: ${Math.floor(Math.random() * 50) + 40}%;"></div></td>
                        </tr>
                    `;
                }

                // Show skeleton loading effect for pagination
                paginationContainer.innerHTML = "";
                for (let i = 0; i < 5; i++) {
                    paginationContainer.innerHTML += `<span class="skeleton-pagination"></span>`;
                }

                // document.querySelector('.loading-screen').classList.add('active');

                fetch(`{{ route('users.json') }}?page=${page}`)
                    .then(response => response.json())
                    .then(data => {
                        tableBody.innerHTML = ""; // Clear skeleton loaders

                        if (!Array.isArray(data.data)) {
                            data.data = Object.values(data.data);
                        }

                        data.data.forEach(user => {
                            let row = `
                                <tr>
                                    <td>${user.id}</td>
                                    <td>${user.first_name}</td>
                                    <td>${user.last_name}</td>
                                    <td>${user.system_access}</td>
                                    <td>${user.role}</td>
                                    <td class="datalist-actions">${user.action}</td>
                                </tr>
                            `;
                            tableBody.innerHTML += row;
                        });

                        updatePagination(data);
                        // document.querySelector('.loading-screen').classList.remove('active');
                    })
                    .catch(error => {
                        console.error('Error fetching users:', error);
                        // document.querySelector('.loading-screen').classList.remove('active');
                    });
            }

            function updatePagination(data) {
                let paginationContainer = document.querySelector('#userPagination');
                paginationContainer.innerHTML = '';

                let currentPage = data.current_page;
                let lastPage = data.last_page;

                if (lastPage > 1) {
                    let paginationHTML = '';

                    if (data.prev_page_url) {
                        paginationHTML += `<a href="#" data-page="${currentPage - 1}" class="prev"><i class="fa-solid fa-caret-left"></i></a>`;
                    }

                    if (currentPage > 3) {
                        paginationHTML += `<a href="#" data-page="1">1</a>`;
                        if (currentPage > 4) paginationHTML += `<a><i class="fa-solid fa-ellipsis"></i></a>`;
                    }

                    let startPage = Math.max(1, currentPage - 2);
                    let endPage = Math.min(lastPage, currentPage + 2);

                    for (let i = startPage; i <= endPage; i++) {
                        paginationHTML += `<a href="#" class="${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</a>`;
                    }

                    if (currentPage < lastPage - 2) {
                        if (currentPage < lastPage - 3) paginationHTML += `<a><i class="fa-solid fa-ellipsis"></i></a>`;
                        paginationHTML += `<a href="#" data-page="${lastPage}">${lastPage}</a>`;
                    }

                    if (data.next_page_url) {
                        paginationHTML += `<a href="#" data-page="${currentPage + 1}" class="next"><i class="fa-solid fa-caret-right"></i></a>`;
                    }

                    paginationContainer.innerHTML = paginationHTML;

                    document.querySelectorAll('#userPagination a').forEach(link => {
                        link.addEventListener('click', function (e) {
                            e.preventDefault();
                            let page = parseInt(this.getAttribute('data-page'));
                            fetchUsers(page);
                        });
                    });
                }
            }

            fetchUsers();
        });

        document.addEventListener("click", function (event) {
            if (event.target.closest(".AccessBtn")) {
                let button = event.target.closest(".AccessBtn");
                let id = button.getAttribute("data-id");
                let fullname = button.getAttribute("data-name");
                let role = button.getAttribute("data-role");
                let action = button.getAttribute("data-action");

                Swal.fire({
                    title: "Are You Sure?",
                    text: `Do you want to ${action === "revoke" ? "Revoke" : "Grant"} access to ${fullname}?`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: action === "revoke" ? "Revoke" : "Grant",
                    cancelButtonText: "Cancel",
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/users/grant-access/${id}/${role}/${action}`, {
                            method: "GET",
                            headers: { "X-Requested-With": "XMLHttpRequest" },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === "success") {
                                Swal.fire({
                                    title: `Access ${action === "revoke" ? "Revoked" : "Granted"}!`,
                                    text: `${fullname} has ${action === "revoke" ? "no" : ""} access to the system.`,
                                    icon: "success",
                                    allowOutsideClick: false,
                                }).then(() => {
                                    window.location.reload(); // Reloads after the user clicks OK
                                });
                            } else {
                                console.log(id);
                                Swal.fire("Error!", "Failed to update access.", "error");
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            Swal.fire("Error!", "Something went wrong.", "error");
                        });
                    }
                });
            }
        });

    </script>
@endsection
