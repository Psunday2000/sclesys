<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Clearance System - User Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Assuming the styles are in the public/css folder -->
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <img src="/images/logo.jpg" alt="" style="max-height: 100px; max-width:50px; object-fit;">
                    <h2 class="heading-section">AIFPU <br> Online Clearance System <br> <b>User Registration</b></h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                            <div class="text w-100">
                                <h2>AIFPU
                                    <br> Online Clearance System <br>
                                </h2>
                                <p>USER LOGIN</p>
                            </div>
                        </div>
                        <div class="login-wrap p-4 p-lg-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">User Registration</h3>
                                </div>
                            </div>
                            <form action="{{ route('register') }}" method="POST" class="signin-form">
                                @csrf <!-- Add CSRF token field -->
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Full Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Full Name"
                                        required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="role">User Type</label>
                                    <select name="role_id" class="form-control" required>
                                        <!-- Populate the select options dynamically from the Roles table -->
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="department">Department</label>
                                    <select name="department_id" class="form-control" required>
                                        <!-- Populate the select options dynamically from the Department table -->
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="email">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email"
                                        required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password"
                                        required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password_confirmation">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="Confirm Password" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit"
                                        class="form-control btn btn-primary submit px-3">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
