@extends('layout.layout')


@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
            <a href="{{ route('customers.create') }}" class="btn rounded-pill btn-info waves-effect waves-light">Add Customer</a>
            </div>
            <div class="card-body">
                <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th data-ordering="false">Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->status }}</td>
                            <td>
                                <a href="{{ route('customers.edit', $customer->user_id) }}" class="btn btn-primary">Edit</a>
                                <button class="btn btn-danger deleteCustomer" data-id="{{ $customer->user_id }}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
 $(document).ready(function () {
     // Delete customer
     $('.deleteCustomer').click(function () {
         var user_id = $(this).data('id'); // Access correct data-id
         if (confirm("Are you sure you want to delete this customer?")) {
             $.ajax({
                 url: '/customers/' + user_id,
                 type: 'DELETE',
                 data: {
                     _token: $('meta[name="csrf-token"]').attr('content'),
                 },
                 success: function (response) {
                     $('#customer_' + user_id).remove(); // Use the correct ID in selector
                     alert(response.success);
                     window.location.reload();
                 },
                 error: function (error) {
                     console.log(error.responseText);
                     alert('Error deleting customer.');
                 }
             });
         }
     });
 });
 </script>
@endsection
