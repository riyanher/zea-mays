<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
