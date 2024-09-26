<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('user', [
            'items' => User::all()
        ]);
    }

    public function delete($id){
        User::find($id)->delete();

        return redirect()->back();
    }
}
