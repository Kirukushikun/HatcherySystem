@extends('admin.admin_UI')

@section('title')
    {{ __('Access Logs List') }}
@endsection

@section('user_logs_content')
<div class="table" id="table3">
    <div class="table-header">
        <h4>Access Logs</h4>

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
        <table id="accessLogs">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">USER ID</th>
                    <th class="text-center">NAME</th>
                    <th class="text-center">DATE/TIME</th>
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
@endsection

@section('scripts_access_logs')
    <script>

        document.addEventListener("DOMContentLoaded", function () {
            let currentPage = 1;

            function fetchUsers(page = 1) {
                let tableBody = document.getElementById('accessLogs');
                let paginationContainer = document.querySelector('#accessLogsPagination');

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
                        </tr>
                    `;
                }

                // Show skeleton loading effect for pagination
                paginationContainer.innerHTML = "";
                for (let i = 0; i < 5; i++) {
                    paginationContainer.innerHTML += `<span class="skeleton-pagination"></span>`;
                }

                // document.querySelector('.loading-screen').classList.add('active');

                fetch(`{{ route('access-logs.json') }}?page=${page}`)
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
                                    <td>${user.user_id}</td>
                                    <td>${user.full_name}</td>
                                    <td>${user.date_time}</td>
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
                let paginationContainer = document.querySelector('#accessLogsPagination');
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

                    document.querySelectorAll('#accessLogsPagination a').forEach(link => {
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

    </script>
@endsection
