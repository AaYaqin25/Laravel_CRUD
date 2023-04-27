@extends('./partials/header')
@section('title', 'Edit User')

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card w-50">
        <div class="card-header text-center">
            <h5>Form Edit</h5>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger" id="error-alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <script>
                setTimeout(function() {
                    $('#error-alert').fadeOut();
                }, 5000);
            </script>

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-auto">
                    <label for="name" class="col-form-label">
                        Name
                    </label>
                </div>
                <div class="col-auto">
                    <input type="text" id="name" name="name" class="form-control" placeholder="name"
                        value="{{ $user->name }}">
                </div>
                <div class="col-auto">
                    <label for="email" class="col-form-label">
                        Email
                    </label>
                </div>
                <div class="col-auto">
                    <input type="email" id="email" name="email" class="form-control" placeholder="email"
                        value="{{ $user->email }}">
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('users.index') }}" class="btn btn-warning">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('./partials/footer')
