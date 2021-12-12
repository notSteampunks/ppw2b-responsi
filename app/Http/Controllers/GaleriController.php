<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Galeri;
use App\Homestay;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image As Image;

class GaleriController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        $batas  = 4;
        $galeri = Galeri::orderBy('id','desc')->paginate($batas);
        $no     = $batas * ($galeri->currentPage() - 1);
        return view('galeri.galeri', compact('galeri','no'));
    }

    public function create()
    {
        $homestay = Homestay::all();
        return view('galeri.creategaleri', compact('homestay'));
    }    

    public function store(Request $request)
    {
        $this->validate($request,[
            'nama_galeri'   =>'required',
            'keterangan'=>'required',
            'foto'          =>'required|image|mimes:jpeg,jpg,png',
        ]);
        $galeri              = New Galeri;
        $galeri->nama_galeri = $request->nama_galeri;
        $galeri->keterangan  = $request->keterangan;
        $galeri->id_homestay = $request->id_homestay;
        
        $galeri->galeri_seo  = Str::slug($request->judul);

        $foto       = $request->foto;
        $namafile   = time().'.'.$foto->getClientOriginalExtension();

        Image::make($foto)->resize(200,150)->save('thumb/'.$namafile);
        $foto->move('images/',$namafile);

        $galeri->foto = $namafile;
        $galeri->save();
        return redirect('/galerihomestay')->with('success_added', 'Galeri Buku berhasil disimpan');
    }

    public function edit($id){
        $galeri     = Galeri::find($id);
        $homestay   = Homestay::all();
        return view('galeri.editgaleri', compact('galeri','homestay'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nama_galeri'   => 'required|string',
            'foto'=>'required|image|mimes:jpeg,jpg,png',
        ]);
        
        $galeri = Galeri::find($id);
        $galeri->nama_galeri     = $request->nama_galeri;
        $galeri->id_homestay     = $request->id_homestay;
        $galeri->id_buku        = $request->id_buku;

        $galeri->galeri_seo  = Str::slug($request->judul);


        $foto       = $request->foto;
        $namafile   = time().'.'.$foto->getClientOriginalExtension();

        Image::make($foto)->resize(200,150)->save('thumb/'.$namafile);
        $foto->move('images/',$namafile);

        $galeri->foto = $namafile;
        $galeri->update();
        return redirect('/galeri')->with('success_updated','Galeri Buku Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $galeri = Galeri::find($id);
        $galeri->delete();
        return redirect('/galerihomestay')->with('success_deleted','Galeri Buku Berhasil Dihapus');
    }
}
