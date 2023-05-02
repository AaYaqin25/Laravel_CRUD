@extends('./partials/header')
@section('title', 'Load User')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Daftar User</h1>
            <a href="{{ route('users.store') }}" class="btn btn-primary">Tambah User</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success text-center" id="alert-userlist">
                    {{ session('success') }}
                </div>
            @endif

            <script>
                setTimeout(function() {
                    $('#alert-userlist').fadeOut('fast');
                }, 5000);
            </script>
            <table class="table" id="users-table">
                <thead>
                    <tr class="table-secondary">
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{route('logout')}}" class="btn btn-warning">Logout</a>
        </div>
    </div>
</div>

@include('./partials/footer')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function confirmDelete(userId) {
        var confirmation = confirm("Are you sure you want to delete this user?");

        if (confirmation) {
            event.preventDefault()
            document.getElementById('delete-user-' + userId).submit();
        }
    }

    $(document).ready(function() {
        $('#users-table').DataTable({
            "lengthMenu": [[3, 10, 100], [3, 10, 100]],
            processing: true,
            serverSide: true,
            ajax: '{{ route('users.data') }}',
            columns: [{
                    data: 'id',
                    name: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'password',
                    name: 'password',
                    render: function(data) {
                        return `******`
                    }
                },
                {
                    data: 'id',
                    name: 'id',
                    render: function(data) {
                        return `
                            <a href="/users/edit/${data}" class="btn btn-circle btn-success">Edit</a>
                            <a href="/users/delete/${data}" class="btn btn-circle btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                            `
                    }
                }
            ]
        });
    });
</script>
