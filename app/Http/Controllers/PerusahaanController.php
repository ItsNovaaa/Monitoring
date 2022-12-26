<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class PerusahaanController extends Controller
{
    public function index() {
        if (request()->ajax()) {
            return DataTables::of(Perusahaan::select('*'))
                ->editColumn('utama', function($data) {
                    if ($data->utama == 1) {
                        return 'Pusat';
                    } else if ($data->utama == 2) {
                        return 'Cabang';
                    } else {
                        return "Kontributor";
                    }
                })
                ->addColumn('_', function($data) {
                    return '<button type="button" class="btn btn-info" onclick="view('.$data->id.')"><i class="fa fa-eye"></i></button>
                            <button type="button" class="btn btn-warning text-light" onclick="edit('.$data->id.')"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger" onclick="destroy('.$data->id.')"><i class="far fa-trash-alt"></i></button>';
                })
                ->rawColumns(['_', 'utama'])
                ->make(true);
        }
        return view('perusahaan.index');
    }

    public function create() {
        return view('perusahaan.create');
    }

    public function store() {
        $post = request()->all();
        $validator = FacadesValidator::make($post, [
            'nama_perusahaan' => 'required',
            'alamat' => 'required',
            'utama' => 'required',
        ], [
            'required' => ':attribute harus diisi'
        ]);
        if ($validator->fails()) {
            return response()->json ([
                'message'  => 'Terjadi kesalahan input',
                'errors' => $validator->errors()
            ], 400);
        }

        $post['created_by'] = auth()->user()->username;
        if (Perusahaan::create($post)) {
            return response()->json([
                'success' => true,
                'message' => 'data berhasil di simpan'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data gagal di simpan'
            ]);
        }
    }

    public function edit($id) {
        $model = Perusahaan::find($id);
        return view('perusahaan.edit', compact('model'));
    }

    public function view($id) {
        $model = Perusahaan::find($id);
        if ($model->utama == 1) {
            $model->utama = 'Pusat';
        } else if ($model->utama == 2) {
            $model->utama = 'Cabang';
        } else {
            $model->utama = "Kontributor";
        }
        return view('perusahaan.view', compact('model'));
    }

    public function update($id) {
        $post = request()->all();
        $validator = FacadesValidator::make($post, [
            'nama_perusahaan' => 'required|unique:perusahaan,id,'.$id,
            'alamat' => 'required',
            'utama' => 'required',
        ], [
            'required' => ':attribute harus diisi'
        ]);
        if ($validator->fails()) {
            return response()->json ([
                'message'  => 'Terjadi kesalahan input',
                'errors' => $validator->errors()
            ], 400);
        }

        $post['updated_by'] = auth()->user()->username;
        $model = Perusahaan::find($id);
        if ($model->update($post)) {
            return response()->json([
                'success' => true,
                'message' => 'data berhasil di diubah'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data gagal di diubah'
            ]);
        }
    }

    public function delete($id) {
        $model = Perusahaan::find($id);
        if ($model) {
            if ($model->delete()) {
                return response()->json([
                    'success' => true,
                    'message' => 'data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'data gagal dihapus'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan'
            ]);
        }
    }
}
