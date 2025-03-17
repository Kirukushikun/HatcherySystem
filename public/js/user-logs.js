

document.addEventListener("DOMContentLoaded", function () {
    let currentPage = 1;
    function fetchUsersLogs(page = 1, sortBy = 'date_time', order = 'desc', searchQuery = '') {
        let tableBody = document.getElementById('accessLogs');
        let paginationContainer = document.querySelector('#accessLogsPagination');
    
        // Show skeleton loaders
        tableBody.innerHTML = "";
        for (let i = 0; i < 10; i++) {
            tableBody.innerHTML += `
                <tr class="skeleton-row">
                    <td><div class="skeleton-loader" style="width: ${Math.random() * 40 + 30}%;"></div></td>
                    <td><div class="skeleton-loader" style="width: ${Math.random() * 50 + 40}%;"></div></td>
                    <td><div class="skeleton-loader" style="width: ${Math.random() * 50 + 40}%;"></div></td>
                    <td><div class="skeleton-loader" style="width: ${Math.random() * 50 + 40}%;"></div></td>
                </tr>
            `;
        }
    0
        paginationContainer.innerHTML = "";
        for (let i = 0; i < 5; i++) {
            paginationContainer.innerHTML += `<span class="skeleton-pagination"></span>`;
        }
    
        fetch(`/access/access-logs-json?page=${page}&sortBy=${sortBy}&order=${order}&search=${encodeURIComponent(searchQuery)}`)
            .then(response => response.json())
            .then(data => {
                tableBody.innerHTML = ""; // Clear skeletons
    
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
    
                updatePaginationLogs(data);
            })
            .catch(error => console.error('Error fetching users:', error));
    }

    document.getElementById('searchLogs').addEventListener('input', function() {
        let searchQuery = this.value;
        fetchUsersLogs(1, 'date_time', document.getElementById('sortOrderLogs').value, searchQuery);
    });

    document.getElementById('sortOrderLogs').addEventListener('change', function() {
        fetchUsersLogs(1, 'date_time', this.value, document.getElementById('searchLogs').value);
        console.log('Sorting order changed to:', this.value);
    });
    
    function updatePaginationLogs(data) {
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
                    fetchUsersLogs(page);
                });
            });
        }
    }

    fetchUsersLogs();
});

