<?php

use App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function add_customer_form()
    {  
      if( \View::exists('customer.create') ){

        return view('customer.create');

      }
    }

    public function submit_customer_data(Request $request)
    {
      $rules = [
          'name' => 'required|min:6',
          'email' => 'required|email|unique:customers'
      ];

      $errorMessage = [
          'required' => 'Enter your :attribute first.'
      ];

      $this->validate($request, $rules, $errorMessage);
      
      Customer::create([
         'name' => $request->name,
         'slug' => \Str::slug($request->name),
         'email' => strtolower($request->email)
      ]);

      $this->meesage('message','Customer created successfully!');
      return redirect()->back();

    }

    public function fetch_all_customer()
    {
       $customers = Customer::toBase()->get();
       return view('customer.index',compact('customers'));
    }

    public function edit_customer_form(Customer $customer)
    { 
       return view('customer.edit',compact('customer'));
    }

    public function edit_customer_form_submit(Request $request, Customer $customer)
    {
      $rules = [
          'name' => 'required|min:6',
          'email' => 'required|email|unique:customers'
      ];

      $errorMessage = [
          'required' => 'Enter your :attribute first.'
      ];

      $this->validate($request, $rules, $errorMessage);

      $customer->update([
                    'name' => $request->name,
                    'email' => strtolower($request->email)
                ]);

      $this->meesage('message','Customer updated successfully!');
      return redirect()->back();
    }

    public function view_single_customer(Customer $customer)
    {
      return view('customer.view',compact('customer'));
    }

    public function delete_customer(Customer $customer)
    {
      $customer->delete();
      $this->meesage('message','Customer deleted successfully!');
      return redirect()->back();
    }

    public function meesage(string $name = null, string $message = null)
    {
        return session()->flash($name,$message);
    }

}
