<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lids;
use Illuminate\Http\Request;

class LidsController extends Controller
{
    public function index(){
        $lids = Lids::all();
        return view('admin.lids.index', compact('lids'));
    }

    public function show($id){
        $lid = Lids::find($id);
        return view('admin.lids.show', compact('lid'));
    }

    public function destroy($id){
        $lid = Lids::find($id);
        $lid->delete();
        return redirect()->route('admin.lids.index');
    }
}
