<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        if(Auth::user()->level == 'admin') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }
        
        $datas = Barang::all();
        return view('barang.index', compact('datas'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->level == 'admin') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }
            

        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
            $barang = new Barang;           
            $barang->NamaBarang = $request->input('NamaBarang');
            $barang->Keterangan = $request->input('Keterangan');
            $barang->Satuan = $request->input('Satuan');
            $barang->IdPengguna = $request->input('IdPengguna');
            // $barang->penulis = auth()->user()->name; 
            // $barang->publish   = $request->input('publish');      
            $barang->save();
        return redirect()->route('barang')->with('sukses', 'Data barang Berhasil Ditambah');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->level == 'admin') {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/'); 
        }

        $data = barang::findOrFail($id);

        return view('barang/show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {   
        if(Auth::user()->level == 'admin') {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }
        $barang = barang::findOrFail($id);
    
        return view('barang/edit', compact('barang'));

    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        
        $barang = barang::find($id);
      
        // $barang->publish   =  $request->input('publish');   
        // $barang->foto          = $nama_image;
        $barang->NamaBarang = $request->input('NamaBarang');
        $barang->Keterangan = $request->input('Keterangan');
        $barang->Satuan = $request->input('Satuan');
        $barang->IdPengguna = $request->input('IdPengguna');
        // $barang->cover             = $request->input('cover');        
        $barang->update();

        // $data->cover = $cover;
        // $data->save();


        // // alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->to('barang/index')->with('sukses', 'Data barang Berhasil Diubah');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)    
    {

       try {
            $barang = Barang::findorfail($id);
            $barang->delete();

            return redirect()->route('barang')->with('sukses', 'Data barang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('warning', 'Maaf data barang tidak dapat dihapus, masih terdapat data yang terpaut dengan data pengguna !');
        }}

}

