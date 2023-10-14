<?php

namespace App\Http\Controllers;

use App\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class beritaController extends Controller
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
        
        $datas = Berita::all();
        return view('berita.index', compact('datas'));
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
            

        return view('berita.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $cover           = $request->file('cover');
        //mengambil nama cover
        $nama_cover      = $cover->getClientOriginalName();
        
        //memindahkan cover ke folder tujuan
        $cover->move('foto_upload',$cover->getClientOriginalName());
            $berita = new Berita;
            $berita->cover          = $nama_cover;
            $berita->judul = $request->input('judul');
            $berita->isi = $request->input('isi');
            $berita->penulis = auth()->user()->name; 
            $berita->publikasi = $request->input('publikasi');
            // $berita->publish   = $request->input('publish');      
            $berita->save();
        return redirect()->route('berita')->with('sukses', 'Data berita Berhasil Ditambah');

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

        $data = Berita::findOrFail($id);

        return view('berita/show', compact('data'));
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
        $berita = Berita::findOrFail($id);
    
        return view('berita/edit', compact('berita'));

    
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
        
        $berita = Berita::find($id);
      
        // $berita->publish   =  $request->input('publish');   
        // $berita->foto          = $nama_image;
        $berita->judul             = $request->input('judul');
        $berita->isi             = $request->input('isi');   
        $berita->penulis = auth()->user()->name; 
        $berita->publikasi             = $request->input('publikasi');   
        // $berita->cover             = $request->input('cover');   
        if($request->file('cover') == "")
        {
           $berita->cover =$berita->cover;
        } 
        else
        {
        
            $file       = $request->file('cover');
            $fileName   = $file->getClientOriginalName();
            $request->file('cover')->move("foto_upload/", $fileName);
           $berita->cover = $fileName;
        }
        $berita->update();

        // $data->cover = $cover;
        // $data->save();


        // // alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->to('berita/index')->with('sukses', 'Data berita Berhasil Diubah');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    
    {
        Berita::findOrFail($id)->delete();
        // alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('berita')->with('sukses', 'Data berita Berhasil Dihapus');
    }

}

