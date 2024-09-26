<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * index user
     */
    public function index(){

        /**
         * just view all user on databases
         */
        return view('user', [
            'items' => User::all()
        ]);
    }

    /**
     * delete spesific user
     */
    public function delete($id){

        /**
         * check if deleted user is myself
         * 
         * I cant delete myself
         */
        if(Auth::id() == $id){
            return redirect()->back()->with('error', "Anda tidak bisa menghapus diri sendiri");
        }

        /**
         * check if user ID is on tugas
         */
        if(Tugas::where('user_id', $id)->exists()){
            return redirect()->back()->with('error', "User punya tugas yang terdaftar, tidak bisa di hapus");
        }

        /**
         * if no relationship, u can delete it
         */
        User::find($id)->delete();

        /**
         * just go back then
         */
        return redirect()->back();
    }
}
