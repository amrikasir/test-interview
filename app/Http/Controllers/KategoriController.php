<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Tugas;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * index view
     * 
     * halaman saat kategori di akses
     */
    public function index(){
        /**
         * tampilkan semua kategori tugas yang terdaftar
         */
        return view('kategori', [
            'items' => Kategori::all()
        ]);
    }

    /**
     * permintaan pembuatan data baru
     */
    public function insert(Request $req){

        /**
         * validate it first, harus unik.
         * 
         * ya kali ada label kategori ganda
         */
        $valid = $req->validate([
            'judul' => 'required|unique:kategoris'
        ]);

        /**
         * simpan di database
         */
        Kategori::create($valid);

        /**
         * dan kembali ke halaman sebelumnya
         */
        return redirect()->back();
    }

    /**
     * proses penghapusan data kategori
     */
    public function delete($id){
        /**
         * check if user ID is on tugas
         */
        if(Tugas::where('kategori_id', $id)->exists()){
            return redirect()->back()->with('error', "User punya tugas yang terdaftar, tidak bisa di hapus");
        }

        Kategori::find($id)->delete();

        return redirect()->back();
    }
}
