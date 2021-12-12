<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Homestay;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image As Image;
use App\Post;

class ListHomestayController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index()
    {
        $batas = 5;
        $data_homestay   = Homestay::orderBy('id', 'desc')->paginate($batas);
        $jumlah_homestay = Homestay::count();
        $no = $batas * ($data_homestay->currentPage() - 1);

        return view('list.listhomestay', compact('data_homestay', 'no','jumlah_homestay'));
    }

    public function create()
    {
        return view('list.createhomestay');
    }    

    public function store(Request $request)
    {
        $this->validate($request,[
            'nama'          => 'required|string',
            'foto'          => 'required|image|mimes:jpeg,jpg,png',
            'lokasi'        => 'required|string|max:30',
            'harga'         => 'required|numeric',
            'tgl_terbit'    => 'required|date',
        ]);
        $homestay               = new Homestay();
        $homestay->nama         = $request->nama;
        // $homestay->gambar_seo   = $request->gambar_seo;
        $homestay->lokasi       = $request->lokasi;
        $homestay->harga        = $request->harga;
        $homestay->tgl_terbit   = $request->tgl_terbit;

        $homestay->gambar_seo   = Str::slug($request->nama);

        $foto       = $request->foto;
        $namafile   = time().'.'.$foto->getClientOriginalExtension();

        Image::make($foto)->resize(270,225)->save('thumb/'.$namafile);
        $foto->move('images/',$namafile);

        $homestay->foto = $namafile;

        $homestay->save();
        return redirect('/listhomestay')->with('success_added','Data Homestay Berhasil disimpan');
    }  

    public function edit($id)
    {
        $homestay = Homestay::find($id);
        return view('list.edithomestay', compact('homestay'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nama'          => 'required|string',
            'foto'          => 'required|image|mimes:jpeg,jpg,png',
            'lokasi'        => 'required|string|max:30',
            'harga'         => 'required|numeric',
            'tgl_terbit'    => 'required|date',
        ]);
        $homestay               = Homestay::find($id);
        $homestay->nama         = $request->nama;
        // $homestay->gambar_seo   = $request->gambar_seo;
        $homestay->lokasi       = $request->lokasi;
        $homestay->harga        = $request->harga;
        $homestay->tgl_terbit   = $request->tgl_terbit;

        $homestay->gambar_seo   = Str::slug($request->nama);

        $foto       = $request->foto;
        $namafile   = time().'.'.$foto->getClientOriginalExtension();

        Image::make($foto)->resize(270,225)->save('thumb/'.$namafile);
        $foto->move('images/',$namafile);

        $homestay->foto = $namafile;

        $homestay->update();
        return redirect('/listhomestay')->with('success_updated','Data Homestay Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $homestay = Homestay::find($id);
        $homestay->delete();
        return redirect('/listhomestay')->with('success_deleted','Data Homestay Berhasil Dihapus');
    }

    public function search(Request $request)
    {
        $batas           = 5;
        $cari            = $request->kata;
        $data_homestay   = Homestay::where('nama','like',"%".$cari."%")->orwhere('lokasi','like',"%".$cari."%")->paginate($batas);
        $jumlah_homestay = $data_homestay->count();
        $no = $batas * ($data_homestay->currentPage() - 1);
        return view('list.searchlisthomestay', compact('jumlah_homestay','data_homestay','no','cari'));
    }  
    public function homestay()
    {
        return view('list.homestay', ['albums' => Homestay::paginate(12)]);
    }
    public function galhomestay($title)
    {
        $albums     = Homestay::where('gambar_seo', $title)->first();
        $galeris    = $albums->photos()->orderBy('id', 'desc')->paginate(6);
        $post       = Post::where('id_homestay', $albums->id)->get();

        return view('/list/detailhomestay', compact('albums','galeris','post'));
    }
    public function likefoto(Request $request, $id)
    {
        $homestay = Homestay::find($id);
        $homestay->increment('like');
        Return back();
    }
}
