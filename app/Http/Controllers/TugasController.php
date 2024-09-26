<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    public function index(){
        $kategori = [];
        foreach(Kategori::all() as $item){
            $kategori[] = [
                'label' => $item->judul,
                'value' => $item->id
            ];
        }

        return view('tugas', [
            'items' => Tugas::all(),
            'status'    => [
                ['label' => 'Selesai', 'value' => 'done'],
                ['label' => 'Dalam Proses', 'value' => 'progress']
            ],
            'kategori' => $kategori,
            'edit'      => false
        ]);
    }

    public function edit($id){
        $kategori = [];
        foreach(Kategori::all() as $item){
            $kategori[] = [
                'label' => $item->judul,
                'value' => $item->id
            ];
        }

        return view('tugas', [
            'items' => Tugas::all(),
            'status'    => [
                ['label' => 'Selesai', 'value' => 'done'],
                ['label' => 'Dalam Proses', 'value' => 'progress']
            ],
            'kategori' => $kategori,
            'edit'      => true,
            'item'      => Tugas::find($id)
        ]);
    }

    public function update(Request $req, $id){
        $tugas = Tugas::find($id);

        $valid = $req->validate([
            'judul'         => 'required',
            'deskripsi'     => 'required',
            'status'        => 'required',
            'kategori_id'   => 'required'
        ]);

        $tugas->update($valid);

        return redirect(route('tugas'));
    }
    public function insert(Request $req){
        $valid = $req->validate([
            'judul'         => 'required|unique:tugas',
            'deskripsi'     => 'required',
            'status'        => 'required',
            'kategori_id'   => 'required'
        ]);

        $data = $valid + [
            'user_id'   => Auth::user()->id
        ];

        Tugas::create($data);

        return redirect()->back();
    }

    public function delete($id){
        Tugas::find($id)->delete();

        return redirect()->back();
    }
}
