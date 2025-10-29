<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $services = service::paginate('12');
      return response()->json ([
        'success' => true,
        'data' => 'Services created successfully',
        'data' => $services,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request ->validate ([
            'description' => 'required|string',
            'price' => 'required',
            'is_active' => 'required',
        ]);

        $services = Service::create($validate);
        return response()->json([
            'sucess' => true,
            'message' => 'service created',
            'data' =>$service
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
