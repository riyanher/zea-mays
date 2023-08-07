<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use Illuminate\Http\Request;
use App\Http\Requests\DesaStoreRequest;
use Illuminate\Support\Facades\Validator;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = \Indonesia::allVillages()->sortBy('name');
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataDesa = new Desa;

        $rules = [
            'code'          => 'required|unique:indonesia_villages,code',
            'district_code' => 'required',
            'name'          => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menambahkan data desa',
                'data' => $validator->errors(),
            ], 422);
        }
        $dataDesa->code = $request->code;
        $dataDesa->district_code = $request->district_code;
        $dataDesa->name = $request->name;
        $dataDesa->meta = $request->meta;

        $post = $dataDesa->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses menambahkan data desa',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $data = \Indonesia::findVillage($id);
        $data = Desa::find($id);
        if($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataDesa = Desa::find($id);
        
        if(empty($dataDesa)){
            return response()->json([
                'status' => false,
                'message' => 'Data desa tidak ditemukan',
            ], 404);
        }

        $rules = [
            'code'          => 'required',
            'district_code' => 'required',
            'name'          => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengubah data desa',
                'data' => $validator->errors(),
            ], 422);
        }

        $dataDesa->code = $request->code;
        $dataDesa->district_code = $request->district_code;
        $dataDesa->name = $request->name;
        $dataDesa->meta = $request->meta;

        $post = $dataDesa->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses mengubah data desa',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
