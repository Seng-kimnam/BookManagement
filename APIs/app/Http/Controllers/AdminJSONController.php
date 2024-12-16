<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;

// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// header("Content-Type: application/json");

 
class AdminJSONController extends Controller
{
    
    public function index()
    {
        $admin = Admin::all();
        return response()->json($admin);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json([
            'default_email_domain' => '@example.com',
            'password_requirements' => 'At least 6 characters',
        ]);
    }

    // function for register from front-end side

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Admin::create( $request->all()); 
          return response()->json(['success' => 'Admin added successfully.'] , 200);
    }
    


    public function show(Admin $admin)
    {
        return response()->json($admin);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin , string $id)
    {
        // $field = $request->validate([
        //     "name" => "required:max:255",
        //     "email" => "required:email",
        // ]);

        // $admin = Admin::find($id);
        // $admin->update($field);
        // return response()->json(['success' => 'Product Updated Successfully.'] , 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    
    }
}
