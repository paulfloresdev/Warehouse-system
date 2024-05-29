<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Area;
use Illuminate\Support\Facades\Validator;

class AreaController extends Controller
{

    public function index()
    {
        $Areas = Area::all();
        return response()->json($Areas);
    }


    public function store(Request $request)
    {
        $rules = ['name' => 'required|string|min:1|max:24'];
        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $Area = new Area($request->input());
        $Area->save();
        return response()->json([
            'status' => true,
            'message' => 'Area created successfully'
        ], 200);
    }


    public function show(Area $Area)
    {
        return response()->json([
            'status' => true,
            'data' => $Area
        ], 200);
    }


    public function update(Request $request, Area $Area)
    {
        $rules = ['name' => 'required|string|min:1|max:24'];
        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $Area->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'Area updated successfully'
        ], 200);
    }


    public function destroy(Area $Area)
    {
        $Area->delete();
        return response()->json([
            'status' => true,
            'message' => 'Area deleted successfully'
        ], 200);
    }
}
