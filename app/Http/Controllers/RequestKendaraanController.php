<?php

namespace App\Http\Controllers;

use App\Models\RequestKendaraan;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;

class RequestKendaraanController extends Controller
{
    public function index() {
        if (request()->ajax()) {
            return DataTables::of(RequestKendaraan::RequestKendaraan())
                ->addColumn('_', function($data) {
                    if (auth()->user()->role == 'pejabat') {
                        if ($data->status == 1) {
                            return '<button type="button" class="btn btn-info" onclick="view('.$data->id.')"><i class="fa fa-eye"></i></button>
                                    <button type="button" class="btn btn-danger" onclick="reject('.$data->id.')"><i class="fas fa-times"></i></button>';
                        } else {
                            return '<button type="button" class="btn btn-info" onclick="view('.$data->id.')"><i class="fa fa-eye"></i></button>
                                    <button type="button" class="btn btn-success" onclick="approve_by_pejabat('.$data->id.')"><i class="fas fa-check"></i></button>
                                    <button type="button" class="btn btn-danger" onclick="reject('.$data->id.')"><i class="fas fa-times"></i></button>';
                        }
                    } else {
                        if ($data->status == 1) {
                            return '<button type="button" class="btn btn-info" onclick="view('.$data->id.')"><i class="fa fa-eye"></i></button>';
                        } else {
                            return '<button type="button" class="btn btn-info" onclick="view('.$data->id.')"><i class="fa fa-eye"></i></button>
                                    <button type="button" class="btn btn-success" onclick="approve('.$data->id.')"><i class="fas fa-check"></i></button>
                                    <button type="button" class="btn btn-warning text-light" onclick="edit('.$data->id.')"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger" onclick="destroy('.$data->id.')"><i class="far fa-trash-alt"></i></button>';
                        }
                    }
                })
                ->editColumn('status', function($data) {
                    $html = "";
                    if ($data->status == 1) {
                        $html = '<button type="button" class="badge badge-success">Approve</button>';
                    } else if ($data->status == 0) {
                        $html = '<button type="button" class="badge badge-warning">Waiting</button>';
                    } else {
                        $html = '<button type="button" class="badge badge-danger">Reject</button>';
                    }
                    return $html;
                })
                ->editColumn('nama_pejabat', function($data) {
                    if ($data->status == 0) {
                        return '';
                    } else {
                        return $data->nama_pejabat;
                    }
                })
                ->rawColumns(['_', 'status', 'nama_pejabat'])
                ->make(true);
        }
        return view('request_kendaraan.index');
    }

    public function create() {
        return view('request_kendaraan.create');
    }

    public function store() {
        $post = request()->all();
        $validator = Validator::make($post, [
            'id_pegawai' => 'required',
            'id_kendaraan' => 'required',
            'tujuan_pemesanan' => 'required',
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
        $post['status'] = 0;
        if (RequestKendaraan::create($post)) {
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
        $model = RequestKendaraan::RequestKendaraan()->where('request_kendaraan.id', $id)->first();
        return view('request_kendaraan.edit', compact('model'));
    }

    public function view($id) {
        $model = RequestKendaraan::RequestKendaraan()->where('request_kendaraan.id', $id)->first();
        return view('request_kendaraan.view', compact('model'));
    }

    public function update($id) {
        $post = request()->all();
        $validator = Validator::make($post, [
            'id_pegawai' => 'required',
            'id_kendaraan' => 'required',
            'tujuan_pemesanan' => 'required',
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
        $model = RequestKendaraan::find($id);
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
        $model = RequestKendaraan::find($id);
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

    public function approve($id) {
        $model = RequestKendaraan::RequestKendaraan()->where('request_kendaraan.id', $id)->first();
        return view('request_kendaraan.approve', compact('model'));
    }

    public function approved($id) {
        $post = request()->all();
        $model = RequestKendaraan::find($id);
        if ($model) {
            $data = [
                'id_approval' => $post['id_approval'],
                'status' => 0
            ];
            if ($model->update($data)) {
                $response = [
                    'success' => true,
                    'message' => 'data berhasil diubah'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'data gagal diubah'
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'data tidak ditemukan'
            ];
        }
        return response()->json($response);
    }

    public function approvedByPejabat($id) {
        $model = RequestKendaraan::find($id);
        if (auth()->user()->role == 'pejabat') {
            if ($model) {
                if ($model->update(['id_approval2' => auth()->user()->id, 'status' => 1])) {
                    return response()->json([
                        'success' => true,
                        'message' => 'persetujuan berhasil'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'persetujuan gagal'
                    ]);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'data tidak ditemukan'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'user tidak memiliki wewenang'
            ]);
        }
    }

    public function reject($id) {
        $model = RequestKendaraan::find($id);
        if (auth()->user()->role == 'pejabat') {
            if ($model) {
                if ($model->update(['id_approval2' => NULL, 'status' => 0])) {
                    return response()->json([
                        'success' => true,
                        'message' => 'reject berhasil'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'reject gagal'
                    ]);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'data tidak ditemukan'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'user tidak memiliki wewenang'
            ]);
        }
    }

    public function export() {
        $spreadsheet = IOFactory::load(public_path('report/riwayat_pemesanan.xlsx'));
        $worksheet = $spreadsheet->getActiveSheet();
        $model = RequestKendaraan::RequestKendaraan()->get();
        $no = 1;
        $row = 6;
        $cols = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

        $style = array(
            'borders' => array(
                'bottom' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
                'left' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
                'right' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),
        );
        $worksheet->getCell('A1')->setValue('Data Riwayat Pemesanan');
        $worksheet->getCell('A2')->setValue("Di Buat Pada : ".date('d-m-Y H:i:s'));
        foreach ($model as $key => $data) {
            $html = "";
            if ($data->status == 1) {
                $html = 'Approve';
            } else if ($data->status == 0) {
                $html = 'Waiting';
            } else {
                $html = 'Reject';
            }
            $worksheet->getCell('A'.$row)->setValue($no);
            $worksheet->getCell('B'.$row)->setValue($data->created_at);
            $worksheet->getCell('C'.$row)->setValue($data->nama_kendaraan);
            $worksheet->getCell('D'.$row)->setValue($data->nama_pegawai);
            $worksheet->getCell('E'.$row)->setValue($data->tujuan_pemesanan);
            $worksheet->getCell('F'.$row)->setValue($html);
            $worksheet->getCell('G'.$row)->setValue($data->nama_pejabat);
            for ($i = 0; $i < 7; $i++) {
                $spreadsheet->getActiveSheet()->getStyle($cols[$i] . $row)->applyFromArray($style);
            }
            $no++;
            $row++;
        }
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        header('Content-Disposition: attachment; filename="riwayat_pemesanan_'.date('Y_m_d-H_i_s').'.xlsx"');
        $writer->save("php://output");
    }
}
