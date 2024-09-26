<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    /**
     * index controller
     * 
     * halaman utama dari route Tugas
     */
    public function index(){
        /**
         * re-formating kategori based on
         * 
         * label & value for selection dropdown
         */
        $kategori = [];
        foreach(Kategori::all() as $item){
            $kategori[] = [
                'label' => $item->judul,
                'value' => $item->id
            ];
        }

        /**
         * return view
         * 
         * @param items semua data Tugas
         * @param status select dropdown untuk status
         * @param kategori select dropdown untuk kategori
         * @param edit apakah view untuk index ataupun edit data
         */
        return view('tugas', [
            'items' => Tugas::where('user_id', Auth::id())->get(),
            'status'    => [
                ['label' => 'Selesai', 'value' => 'done'],
                ['label' => 'Dalam Proses', 'value' => 'progress']
            ],
            'kategori' => $kategori,
            'edit'      => false
        ]);
    }

    /**
     * index edit
     * 
     * halaman saat tombol edit di click
     */
    public function edit($id){

        /**
         * re-formating kategori based on
         * 
         * label & value for selection dropdown
         */
        $kategori = [];
        foreach(Kategori::all() as $item){
            $kategori[] = [
                'label' => $item->judul,
                'value' => $item->id
            ];
        }

        /**
         * return view
         * 
         * @param items semua data Tugas
         * @param status select dropdown untuk status
         * @param kategori select dropdown untuk kategori
         * @param edit apakah view untuk index ataupun edit data
         * 
         * @param item current data Tugas yang akan di edit
         */
        return view('tugas', [
            'items' => Tugas::where('user_id', Auth::id())->get(),
            'status'    => [
                ['label' => 'Selesai', 'value' => 'done'],
                ['label' => 'Dalam Proses', 'value' => 'progress']
            ],
            'kategori' => $kategori,
            'edit'      => true,
            'item'      => Tugas::find($id)
        ]);
    }

    /**
     * process to update record
     */
    public function update(Request $req, $id){

        /**
         * find tugas based on ID
         */
        $tugas = Tugas::find($id);

        /**
         * basic validation
         */
        $valid = $req->validate([
            'judul'         => 'required',
            'deskripsi'     => 'required',
            'status'        => 'required',
            'kategori_id'   => 'required'
        ]);

        /**
         * update record based on form
         */
        $tugas->update($valid);

        /**
         * redirect back to togas index
         */
        return redirect(route('tugas'));
    }

    /**
     * insert new record to database
     */
    public function insert(Request $req){

        /**
         * validation rules, still basic
         */
        $valid = $req->validate([
            'judul'         => 'required|unique:tugas',
            'deskripsi'     => 'required',
            'status'        => 'required',
            'kategori_id'   => 'required'
        ]);

        /**
         * insert validated record to databased
         * 
         * plus, user_id based on user login
         */
        Tugas::create($valid + [
            'user_id'   => Auth::user()->id
        ]);

        /**
         * just go back where you from
         */
        return redirect()->back();
    }

    /**
     * delete record function
     */
    public function delete($id){
        /**
         * find record based on id and user login
         */
        Tugas::where('id', $id)
        ->where('user_id', Auth::id())

        /**
         * destroy it
         */
        ->delete();

        /**
         * and go back to last URL
         */
        return redirect()->back();
    }
}
