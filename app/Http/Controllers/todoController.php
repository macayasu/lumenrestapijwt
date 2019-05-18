<?php

namespace App\Http\Controllers;

use App\ModelTodo;
use Illuminate\Http\Request;

class todoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $data = ModelTodo::all();

        if (!$data) {
            $response = [
                'message' => 'Tidak ada data',
            ];
            return response()->json($response, 401);
        }
        $response = [
            'message' => 'List of all Todo',
            'todo' => $data
        ];

        return response()->json($response, 200);
    }

    public function show($id)
    {
        $data = ModelTodo::where('id', $id)->first();

        if (!$data) {
            $response = [
                'message' => 'Tidak Menemukan ID',
            ];
            return response()->json($response, 401);
        };

        $response = [
            'message' => 'List Todo Detail',
            'todo' => $data
        ];
        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'activity' => 'required',
            'description' => 'required'
        ]);

        $activity = $request->input('activity');
        $description = $request->input('description');

        $data = new ModelTodo([
            'activity' => $activity,
            'description' => $description
        ]);

        if ($data->save()) {
            $response = [
                'message' => 'Berhasil Tambah Data!',
                'todo' => $data
            ];

            return response()->json($response, 201);
        }

        $response = [
            'message' => 'Gagal Tambah Data!'
        ];
        return response()->json($response, 404);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'activity' => 'nullable',
            'description' => 'nullable'
        ]);

        $activity = $request->input('activity');
        $description = $request->input('description');

        $data = ModelTodo::where('id', $id)->first();

        if (!$data) {
            $response = [
                'message' => 'Todo dengan id tersebut tidak ditemukan'
            ];

            return response()->json($response, 401);
        };

        $data->activity = $activity;
        $data->description = $description;

        if (!$data->update()) {
            $response = [
                'message' => 'Gagal mengupdate'
            ];
            return response()->json($response, 401);
        };

        $response = [
            'message' => 'Sukses mengupdate',
            'todo' => $data
        ];
        return response()->json($response, 201);
    }

    public function destroy($id)
    {
        $data = ModelTodo::where('id', $id)->first();
        if (!$data) {
            $response = [
                'message' => 'Tidak Menemukan ID'
            ];
            return response()->json($response, 401);
        };

        if (!$data->delete()) {
            $response = [
                'message' => 'Gagal Menghapus Data'
            ];
            return response()->json($response, 401);
        }
        $response = [
            'message' => 'Sukses Menghapus Data',
            'todo' => $data
        ];
        return response()->json($response, 201);
    }

    //
}
