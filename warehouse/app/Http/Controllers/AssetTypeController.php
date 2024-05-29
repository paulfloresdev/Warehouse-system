<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\AssetType;
use Illuminate\Support\Facades\Validator;

class AssetTypeController extends Controller
{

    public function index()
    {
        $AssetTypes = AssetType::all();
        return response()->json($AssetTypes);
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
        $AssetType = new AssetType($request->input());
        $AssetType->save();
        return response()->json([
            'status' => true,
            'message' => 'AssetType created successfully'
        ], 200);
    }


    public function show(AssetType $AssetType)
    {
        return response()->json([
            'status' => true,
            'data' => $AssetType
        ], 200);
    }


    public function update(Request $request, AssetType $AssetType)
    {
        $rules = ['name' => 'required|string|min:1|max:24'];
        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $AssetType->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'AssetType updated successfully'
        ], 200);
    }


    public function destroy(AssetType $AssetType)
    {
        $AssetType->delete();
        return response()->json([
            'status' => true,
            'message' => 'AssetType deleted successfully'
        ], 200);
    }
}
