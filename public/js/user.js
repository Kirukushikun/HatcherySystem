
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

        fetch(`/users/json?page=${page}`)
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

                updatePaginationUser(data);
                // document.querySelector('.loading-screen').classList.remove('active');
            })
            .catch(error => {
                console.error('Error fetching users:', error);
                // document.querySelector('.loading-screen').classList.remove('active');
            });
    }

    function updatePaginationUser(data) {
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
