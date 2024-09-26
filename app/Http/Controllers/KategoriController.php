<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(){
        return view('kategori', [
            'items' => Kategori::all()
        ]);
    }

    public function insert(Request $req){
        $valid = $req->validate([
            'judul' => 'required|unique:kategoris'
        ]);

        Kategori::create($valid);

        return redirect()->back();
    }

    public function delete($id){
        Kategori::find($id)->delete();

        return redirect()->back();
    }
}
