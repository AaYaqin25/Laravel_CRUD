@extends('./partials/header')
@section('title', 'Load User')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Daftar User</h1>
            <a href="{{ route('users.store') }}" class="btn btn-primary">Tambah User</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr class="table-secondary">
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>******</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success">Edit</a>
                                <button class="btn btn-danger"
                                    onclick="confirmDelete({{ $user->id }})">Delete</button>
                                <form id="delete-user-{{ $user->id }}"
                                    action="{{ route('users.delete', $user->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('./partials/footer')
<script>
    function confirmDelete(userId) {
        var confirmation = confirm("Are you sure you want to delete this user?");

        if (confirmation) {
            event.preventDefault()
            document.getElementById('delete-user-' + userId).submit();
        }
    }
</script>
