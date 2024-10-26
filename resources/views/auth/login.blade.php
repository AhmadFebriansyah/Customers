@extends('layout.auth_layout')

@section('content')
<!-- auth page content -->
<div class="auth-page-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card mt-4">
                    <div class="card-body p-4">
                        <div class="text-center mt-2">
                            <h5 class="text-primary">Sign In</h5>
                        </div>
                        <div class="p-2 mt-4">
                            <!-- Add an ID to the form -->
                            <form id="login-form" method="post" enctype="multipart/form-data">
                                @csrf
                                @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{Session::get('success')}}
                                </div>
                                @endif
                                @if (Session::has('fail'))
                                <div class="alert alert-danger">
                                    {{Session::get('fail')}}
                                </div>
                                @endif
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                                    <span class="text-danger">
                                        @error('email')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="password-input">Password</label>
                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                        <input type="password" class="form-control pe-5 password-input" name="password" placeholder="Enter password" id="password-input" required>
                                        <span class="text-danger">
                                            @error('password')
                                            {{$message}}
                                            @enderror
                                        </span>
                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted shadow-none password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button class="btn btn-success w-100" type="submit">Sign In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                
                <div class="mt-4 text-center">
                    <p class="mb-0">Don't have an account? <a href="registration" class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end auth page content -->

<!-- Include jQuery if it's not already included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#login-form').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = $(this).serialize(); // Serialize the form data

            // AJAX request
            $.ajax({
                url: '{{ route("login-user") }}', // Use the named route for the login
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log('Response:', response);
                    if (response.success) {
                        // SweetAlert success alert
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Redirect after the SweetAlert is closed
                            window.location.href = '/customers'; // Redirect to the customers page
                        });
                    } else {
                        // Handle the case where response.success is false
                        Swal.fire({
                            title: 'Error!',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr) {
                    // Handle validation errors
                    var errors = xhr.responseJSON.errors;
                    if (errors.email) {
                        $('#email').next('.text-danger').text(errors.email[0]);
                    }
                    if (errors.password) {
                        $('#password-input').next('.text-danger').text(errors.password[0]);
                    }
                    // Optionally display a generic error message
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was a problem with your submission. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>
@endsection
