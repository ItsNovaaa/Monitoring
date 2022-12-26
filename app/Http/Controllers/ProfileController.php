<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() {
        return view('profile.index');
    }

    public function update($id) {
        $post = request()->all();
        if ($post['password'] <> $post['confirm_password']) {
            return redirect()->back()->with('error', 'Password & Konfirmasi Password Tidak Sama');
        }
        $model = User::find($id);
        if ($model) {
            if ($model->update([
                'username' => $post['username'],
                'password' => bcrypt($post['password']) 
            ])) {
                return redirect()->back()->with('success', 'Data Berhasil Diubah');
            } else {
                return redirect()->back()->with('false', 'Data Gagal Diubah');
            }
        } else {
            return redirect()->back()->with('false', 'Data Tidak Ditemukan');
        }
    }
}
