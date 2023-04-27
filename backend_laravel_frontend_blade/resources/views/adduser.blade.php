@extends('./partials/header')
@section('title', 'Add User')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card w-50">
        <div class="card-header text-center">
            <h5>Form Add</h5>
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

            <form action="{{ route('users.create') }}" method="POST">
                @csrf
                <div class="col-auto">
                    <label for="name" class="col-form-label">
                        Name
                    </label>
                </div>
                <div class="col-auto">
                    <input type="text" id="name" name="name" class="form-control" placeholder="name">
                </div>
                <div class="col-auto">
                    <label for="email" class="col-form-label">
                        Email
                    </label>
                </div>
                <div class="col-auto">
                    <input type="email" id="email" name="email" class="form-control" placeholder="email">
                </div>
                <div class="col-auto">
                    <label for="password" class="col-form-label">
                        Password
                    </label>
                </div>
                <div class="col-auto">
                    <input type="password" id="password" name="password" class="form-control" placeholder="password">
                </div>
                <div class="col-auto">
                    <label for="passwordconfirmation" class="col-form-label">
                        Password Confirmation
                    </label>
                </div>
                <div class="col-auto">
                    <input type="password" id="passwordconfirmation" name="password_confirmation" class="form-control"
                        placeholder="password confirmation">
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">save</button>
                    <a href="{{ route('users.index') }}" class="btn btn-warning">cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('./partials/footer')
