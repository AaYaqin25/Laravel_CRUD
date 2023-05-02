@extends('./partials/header')
@section('title', 'Login')

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card">
        <div class="card-header text-center">
            <h5>Form Login</h5>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger text-center" id="alert-formlogin">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success text-center" id="alert-formlogin">
                    {{ session('success') }}
                </div>
            @endif

            <script>
                setTimeout(function() {
                    $('#alert-formlogin').fadeOut();
                }, 5000);
            </script>

            <form method="POST" action="{{ route('login') }}">
                @csrf
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
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>

</div>


@include('./partials/footer')
