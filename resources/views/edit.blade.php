@extends('layout.layout')


@section('content')

<div class="row">   
    <div class="col-xxl-6">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Update Customer</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <form id="customerForm" method="POST" action="{{ route('customers.update') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="user_id" class="form-label">User Id</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter your name" value="{{ $customer->user_id }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="nameInput" class="form-label">Name</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="nameInput" name="name" placeholder="Enter your name" value="{{ $customer->name }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="leaveemails" class="form-label">Email</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="email" class="form-control" id="leaveemails" name="email" placeholder="Enter your email" value="{{ $customer->email }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="leaveemails" class="form-label">Status</label>
                        </div>
                        <div class="col-lg-9">
                            <select class="form-select mb-3" name="status">
                                <option value="NEW CUSTOMER" {{ $customer->status == 'NEW CUSTOMER' ? 'selected' : '' }}>NEW CUSTOMER</option>
                                <option value="LOYAL CUSTOMER" {{ $customer->status == 'LOYAL CUSTOMER' ? 'selected' : '' }}>LOYAL CUSTOMER</option>
                            </select>
                            
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#customerForm').submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        Swal.fire({
            title: 'Processing...',
            text: 'Please wait.',
            icon: 'info',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        $.ajax({
            url: '/customers/update', 
            type: 'POST',
            data: formData,
            success: function (response) {
                Swal.close(); 
                
                if (response.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.success,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = '/customers';
                    });
                }
            },
            error: function (xhr, status, error) {
                Swal.close();
                
                Swal.fire({
                    title: 'Error!',
                    text: 'There was a problem submitting your data. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                
                console.error('AJAX Error:', error); 
                console.error('Status:', status); 
                console.error('Response:', xhr.responseText);
            }
        });
    });
    });
    
</script>
@endsection

