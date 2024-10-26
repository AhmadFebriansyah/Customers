<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerAddedMail;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $title = 'Customer List';
        return view('customers', compact('customers', 'title'));
    }
    
    public function create()
    {
        $title = 'Add Customer';
        return view('create', compact('title'));
    }
    
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
        ]);
        
        // Generate customer ID based on date and count
        $currentDate = now();
        $formattedDate = $currentDate->format('Yd') . $currentDate->format('m');
        $customerCount = Customer::count();
        $uniquePart = str_pad($customerCount + 1, 2, '0', STR_PAD_LEFT);
        $customerId = $formattedDate . $uniquePart;
        
        // Create the customer
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_id' => $customerId,
            'status' => 'NEW CUSTOMER',
        ]);
        
        Log::info('Attempting to send email to: ' . $customer->email);
        
        // Check if email exists before sending
        if ($customer->email) {
            try {
                Mail::to($customer->email)->send(new CustomerAddedMail($customer->name));
            } catch (\Exception $e) {
                Log::error('Error sending email: ' . $e->getMessage());
            }
        } else {
            Log::error('Customer email is null.');
        }
        
        // Return response
        return response()->json(['success' => 'Customer added successfully and email sent.']);
    }
    
    public function edit($user_id)
    {
        $customer = Customer::where('user_id', $user_id)->first();
        $title = 'Edit Customer';
        
        return view('edit', compact('customer', 'title'));
    }
    
    public function update(Request $request)
    {
        $customer = Customer::where('user_id', $request->user_id)->first();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'status' => 'required|string'
        ]);
        
        // Update the customer record
        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status
        ]);
        
        return response()->json(['success' => 'Customer updated successfully']);
    }
    
    public function destroy($user_id)
    {
        $customer = Customer::where('user_id', $user_id)->delete();
        return response()->json(['success' => 'Customer deleted successfully.']);
    }
    
    public function showCustomerChart()
    {
        $title = 'Dashboard Customer';
        $newCustomers = Customer::where('status', 'New Customer')->count();
        $loyalCustomers = Customer::where('status', 'Loyal Customer')->count();
        return view('auth.dashboard', compact('newCustomers', 'loyalCustomers', 'title'));
    }
}