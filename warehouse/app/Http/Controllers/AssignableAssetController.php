<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\AssignableAsset;
use Illuminate\Support\Facades\Validator;

class AssignableAssetController extends Controller
{

    public function index()
    {
        $AssignableAssets = AssignableAsset::all();
        return response()->json($AssignableAssets);
    }


    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:1|max:64',
            'brand' => 'required|string|min:1|max:64',
            'model' => 'required|string|min:1|max:128',
            'description' => 'required|string|min:1|max:1024',
            'serial_number' => 'required|string|min:1|max:48|unique:assignable_assets',
            'barcode' => 'required|string|min:1|max:20|unique:assignable_assets',
            'purchase_date' => 'required|date',
            'purchase_price' => 'required|numeric|min:0',
            'condition' => 'required|string|min:1|max:24',
            'out_pass' => 'required|boolean',
            'rack' => 'required|string|min:1|max:16',
            'shelf' => 'required|string|min:1|max:16',
            'box' => 'required|string|min:1|max:16',
            'supplier_id' => 'required|exists:suppliers,id',
            'type_id' => 'required|exists:asset_types,id',
        ];
        
        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $AssignableAsset = new AssignableAsset($request->input());
        $AssignableAsset->save();
        return response()->json([
            'status' => true,
            'message' => 'AssignableAsset created successfully'
        ], 200);
    }


    public function show(AssignableAsset $AssignableAsset)
    {
        return response()->json([
            'status' => true,
            'data' => $AssignableAsset
        ], 200);
    }


    public function update(Request $request, AssignableAsset $AssignableAsset)
    {
        $rules = [
            'name' => 'required|string|min:1|max:64',
            'brand' => 'required|string|min:1|max:64',
            'model' => 'required|string|min:1|max:128',
            'description' => 'required|string|min:1|max:1024',
            'serial_number' => 'required|string|min:1|max:48|unique:assignable_assets',
            'barcode' => 'required|string|min:1|max:20|unique:assignable_assets',
            'purchase_date' => 'required|date',
            'purchase_price' => 'required|numeric|min:0',
            'condition' => 'required|string|min:1|max:24',
            'out_pass' => 'required|boolean',
            'rack' => 'required|string|min:1|max:16',
            'shelf' => 'required|string|min:1|max:16',
            'box' => 'required|string|min:1|max:16',
            'supplier_id' => 'required|exists:suppliers,id',
            'type_id' => 'required|exists:asset_types,id',
        ];
        
        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $AssignableAsset->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'AssignableAsset updated successfully'
        ], 200);
    }


    public function destroy(AssignableAsset $AssignableAsset)
    {
        $AssignableAsset->delete();
        return response()->json([
            'status' => true,
            'message' => 'AssignableAsset deleted successfully'
        ], 200);
    }
}
