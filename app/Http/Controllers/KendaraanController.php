<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KendaraanController extends Controller
{
    public function index() {
        if (request()->ajax()) {
            return DataTables::of(Kendaraan::select('kendaraan.*', 'perusahaan.nama_perusahaan')->join('perusahaan', 'perusahaan.id', 'kendaraan.id_perusahaan'))
                ->addColumn('_', function($data) {
                    return '<button type="button" class="btn btn-info" onclick="view('.$data->id.')"><i class="fa fa-eye"></i></button>
                            <button type="button" class="btn btn-warning text-light" onclick="edit('.$data->id.')"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger" onclick="destroy('.$data->id.')"><i class="far fa-trash-alt"></i></button>';
                })
                ->editColumn('tipe_kendaraan', function($data) {
                    return ucwords($data->tipe_kendaraan);
                })
                ->rawColumns(['_', 'tipe_kendaraan'])
                ->make(true);
        }
        return view('kendaraan.index');
    }

    public function create() {
        return view('kendaraan.create');
    }

    public function store() {
        $post = request()->all();
        $validator = Validator::make($post, [
            'id_perusahaan' => 'required',
            'nama_kendaraan' => 'required',
            'jenis_kendaraan' => 'required',
            'tipe_kendaraan' => 'required',
        ], [
            'required' => ':attribute harus diisi'
        ]);
        if ($validator->fails()) {
            return response()->json ([
                'message'  => 'Terjadi kesalahan input',
                'errors' => $validator->errors()
            ], 400);
        }

        if (isset($post['sewaan'])) {
            $post['dari_tanggal'] = date('Y-m-d', strtotime($post['dari_tanggal']));
            $post['sampai_tanggal'] = date('Y-m-d', strtotime($post['sampai_tanggal']));
            $post['sewa'] = 1;
        }
        $post['status_unit'] = 1;
        $post['status'] = 1;
        $post['jadwal_service'] = date('Y-m-d', strtotime($post['jadwal_service']));
        $post['created_by'] = auth()->user()->username;
        if (Kendaraan::create($post)) {
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
        $model = Kendaraan::select('kendaraan.*', 'perusahaan.nama_perusahaan')->join('perusahaan', 'perusahaan.id', 'kendaraan.id_perusahaan')->where('kendaraan.id', $id)->first();
        return view('kendaraan.edit', compact('model'));
    }

    public function view($id) {
        $model = Kendaraan::select('kendaraan.*', 'perusahaan.nama_perusahaan')->join('perusahaan', 'perusahaan.id', 'kendaraan.id_perusahaan')->where('kendaraan.id', $id)->first();
        return view('kendaraan.view', compact('model'));
    }

    public function update($id) {
        $post = request()->all();
        $validator = Validator::make($post, [
            'id_perusahaan' => 'required',
            'nama_kendaraan' => 'required',
            'jenis_kendaraan' => 'required',
            'tipe_kendaraan' => 'required',
        ], [
            'required' => ':attribute harus diisi'
        ]);
        if ($validator->fails()) {
            return response()->json ([
                'message'  => 'Terjadi kesalahan input',
                'errors' => $validator->errors()
            ], 400);
        }

        if (isset($post['sewaan'])) {
            $post['dari_tanggal'] = date('Y-m-d', strtotime($post['dari_tanggal']));
            $post['sampai_tanggal'] = date('Y-m-d', strtotime($post['sampai_tanggal']));
            $post['sewa'] = 1;
        }
        $post['updated_by'] = auth()->user()->username;
        $post['status_unit'] = 1;
        $post['status'] = 1;
        $post['jadwal_service'] = date('Y-m-d', strtotime($post['jadwal_service']));
        $model = Kendaraan::find($id);
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
        $model = Kendaraan::find($id);
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
