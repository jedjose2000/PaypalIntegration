<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="login-style.css" />
    @include('shared.imports')
</head>

<body>
    <div class="container main-container">
        <div class="container bg-white rounded">
        <div id="backArrow" class="return mt-2 ms-2"><a class="a-return" href="{{ route('home') }}"><i
            class="fa-solid fa-arrow-left"></i></a></div>
            <div class="row">
                <div class="col  d-flex justify-content-center align-items-center">
                    <div class="p-3">
                    <div class="container-fluid error-status">
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>    
                            @endforeach
                            </div>
                        <form id="loginForm" action="{{ route('create-account') }}" method="POST">
                        {{ csrf_field() }}
                            <div class="text-center mb-5">
                                <p class="lead mb-0 me-3 fs-1 fw-bold">Create Account</p>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label fw-bold" for="username">Username</label>
                                <input type="text" name="username" id="form3Example3" class="form-control form-control"
                                    placeholder="Enter username" required />
                            </div>
                            <div class="form-outline mb-3">
                                <label class="form-label fw-bold" for="password">Password</label>
                                <input type="password" name="password" id="form3Example4"
                                    class="form-control form-control" placeholder="Enter password" required />
                            </div>
                            <div class="form-outline mb-3">
                                <label class="form-label fw-bold" for="email">Email</label>
                                <input type="email" name="email" id="form3Example5"
                                    class="form-control form-control" placeholder="Enter email" required />
                            </div>
                            <div class="text-center mt-4 pt-2">
                                <button type="submit" class="btn btn-primary "
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;">CREATE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f38a62f9ed.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
    integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

</body>

</html>