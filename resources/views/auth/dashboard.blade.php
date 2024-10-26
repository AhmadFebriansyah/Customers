@extends('layout.layout')

@section('content')
<div class="container mt-5">
    <canvas id="customerChart" width="400" height="200"></canvas>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('customerChart').getContext('2d');
        var customerChart = new Chart(ctx, {
            type: 'bar',  
            data: {
                labels: ['New Customer', 'Loyal Customer'],  
                datasets: [{
                    label: 'Status Customer',
                    data: [{{ $newCustomers }}, {{ $loyalCustomers }}],  
                    backgroundColor: [
                        'lime',  // Color for New Customer
                        'red'   // Color for Loyal Customer
                    ],
                    borderColor: [
                        'lime',    // Border color for New Customer
                        'red'     // Border color for Loyal Customer
                    ],
                    borderWidth: 0.5
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }   
                }
            }
        });
    });
</script>
@endsection
