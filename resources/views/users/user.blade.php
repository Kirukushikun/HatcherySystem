@extends('admin.admin_UI')

@section('title')
    {{ __('Users List') }}
@endsection

@section('user_content')
<div class="table active" id="table4">
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
    <div class="table-body">
        <table id="users">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">FIRST NAME</th>
                    <th class="text-center">LAST NAME</th>
                    <th class="text-center">SYSTEM ACCESS</th>
                    <th class="text-center">ROLE</th>
                    <th class="text-center">ACTION</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <!-- Dynamic rows will be inserted here -->
            </tbody>
        </table>
    </div>
    {{-- <div class="table-footer">
        <div class="pagination">
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#"><i class="fa-solid fa-caret-right"></i></a>
        </div>
    </div> --}}
</div>
@endsection

@section('scriptss')
    {{-- @if(isset($_GET["acc"]))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: 'Access Granted!',
                    text: 'Granted Access to User',
                    icon: 'success'
                }).then(() => {
                    window.location.href = "{{ route('user.show') }}"; // Replace with your actual route name
                });
            });
        </script>
    @endif --}}
    <script>


        // @if(session('success'))
        //     Swal.fire(
        //       'Success!',
        //       '{{ session('success') }}',
        //       'success'
        //     );
        // @elseif(session('failed'))
        //     Swal.fire(
        //       'Failed!',
        //       '{{ session('failed') }}',
        //       'error'
        //     );
        // @endif
        // $(document).on('click', '#refresh', function(e) {
        //     var users = $('#users').DataTable();
        //     users.ajax.reload();
        // });

        document.addEventListener("DOMContentLoaded", function() {
            fetch("{{ route('users.json') }}")
                .then(response => response.json())
                .then(data => {
                    let tableBody = document.getElementById('userTableBody');
                    tableBody.innerHTML = ""; // Clear existing rows

                    data.forEach(user => {
                        let row = `
                            <tr>
                                <td>${user.id}</td>
                                <td>${user.first_name}</td>
                                <td>${user.last_name}</td>
                                <td>${user.system_access}</td>
                                <td>${user.role}</td>
                                <td>${user.action}</td>
                            </tr>
                        `;
                        tableBody.innerHTML += row;
                    });
                })
                .catch(error => console.error('Error fetching users:', error));
        });

        // @if (session()->has('success'))
        //     Swal.fire(
        //       'Success!',
        //       '{{ session('success') }}',
        //       'success'
        //     );
        // @elseif(session()->has('failed'))
        //     Swal.fire(
        //       'Failed!',
        //       '{{ session('failed') }}',
        //       'error'
        //     );
        // @endif
    </script>
@endsection



