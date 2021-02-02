<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuruModel;
use Dompdf\Dompdf;

class GuruController extends Controller
{
    public function __construct() {
        $this->GuruModel=new GuruModel();
        // agar user login dulu
        $this->middleware('auth');
    }

    public function index(){
        $data=[
            'gurus'=>$this->GuruModel->tampil(),
        ];
        return view('v_guru',$data);
    }

    public function detail($id_guru){
        if(!$this->GuruModel->detailData($id_guru)){
            abort(404);
        }
        $data=[
            'guru'=>$this->GuruModel->detailData($id_guru),
        ];
        return view('v_detailGuru',$data);
    }

    public function add(){
        return view('v_addGuru');
    }

    public function validasi(){
        // validasi
        Request()->validate([
            'nip_guru' => 'required|unique:guru,nip_guru|min:4|max:5',
            'nama_guru' => 'required',
            'mapel_guru' => 'required',
            'id_jam' => 'required',
            'foto_guru' => 'required|mimes:jpg,bmp,png,jpeg|max:2024'
        ],
        // isi pesan error
        [
            'nip_guru.required'=>'Wajib diisi',
            'nip_guru.unique'=>'Nip sudah terdaftar',
            'nip_guru.min'=>'Minimal 4 karakter',
            'nip_guru.max'=>'Minimal 5 karakter',

            'nama_guru.required'=>'Wajib diisi',
            'mapel_guru.required'=>'Wajib diisi',
            'id_jam.required'=>'Wajib diisi',

            'foto_guru.required'=>'Wajib diisi',
            'foto_guru.mimes'=>'Yang diupload harus jpg,bmp,png,jpeg',
            'foto_guru.max'=>'Tidak boleh lebih dari 2mb'
        ]
    );
    // 2.
    // upload gambar
    
    $file=Request()->foto_guru;
    // membuat nama foto berdasarkan nip
    $fileName=Request()->nip_guru.'.'.$file->extension();
    // memindah file dan memberinama dengan $filename
    // public_path yaitu mengambil dari folder public
    // dan diberi nama $fileName
    $file->move(public_path('foto_guru'),$fileName);

    // memasukkan data yang akan dikirim ke guru model.php ke function prosesGuru
    $data=[
        'nip_guru'=>Request()->nip_guru,
        'nama_guru'=>Request()->nama_guru,
        'mapel_guru'=>Request()->mapel_guru,
        'id_jam'=>Request()->id_jam,
        'foto_guru'=>$fileName,
    ];
    // dikirim ke guru model.php ke function prosesGuru
    $this->GuruModel->prosesGuru($data);
    // 3.jika sukses redirect ke route yang bernama guru
    // membuat var pesan 
    return redirect()->route('guru')->with('pesan','Tambah data berhasil');
    }

    // edit
    public function edit($id_guru){
        if(!$this->GuruModel->detailData($id_guru)){
            abort(404);
        }
        $data=[
            'guru'=>$this->GuruModel->detailData($id_guru),
        ];
        return view('v_editGuru',$data);
    }

    public function prosesEdit($id_guru){
        // validasi
        Request()->validate([
            'nip_guru' => 'required|min:4|max:5',
            'nama_guru' => 'required',
            'mapel_guru' => 'required',
            'id_jam' => 'required',
            'foto_guru' => 'mimes:jpg,bmp,png,jpeg|max:2024'
        ],
        // isi pesan error
        [
            'nip_guru.required'=>'Wajib diisi',
            'nip_guru.min'=>'Minimal 4 karakter',
            'nip_guru.max'=>'Minimal 5 karakter',

            'nama_guru.required'=>'Wajib diisi',
            'mapel_guru.required'=>'Wajib diisi',
            'id_jam.required'=>'Wajib diisi',

            'foto_guru.mimes'=>'Yang diupload harus jpg,bmp,png,jpeg',
            'foto_guru.max'=>'Tidak boleh lebih dari 2mb'
        ]
    );
    // 2.
    // upload gambar
    if(Request()->foto_guru<>""){
    // jika foto guru tidak kosong
    // jika update gambar
    $file=Request()->foto_guru;
    // membuat nama foto berdasarkan nip
    $fileName=Request()->nip_guru.'.'.$file->extension();
    // memindah file dan memberinama dengan $filename
    // public_path yaitu mengambil dari folder public
    // dan diberi nama $fileName
    $file->move(public_path('foto_guru'),$fileName);

    // memasukkan data yang akan dikirim ke guru model.php ke function prosesGuru
    $data=[
        'nip_guru'=>Request()->nip_guru,
        'nama_guru'=>Request()->nama_guru,
        'mapel_guru'=>Request()->mapel_guru,
        'id_jam'=>Request()->id_jam,
        'foto_guru'=>$fileName,
    ];
    }else{
        // jika tidak update gambar

        // memasukkan data yang akan dikirim ke guru model.php ke function prosesGuru
        $data=[
            'nip_guru'=>Request()->nip_guru,
            'nama_guru'=>Request()->nama_guru,
            'mapel_guru'=>Request()->mapel_guru,
            'id_jam'=>Request()->id_jam,
        ];
    }
    
    // dikirim ke guru model.php ke function prosesGuru
    $this->GuruModel->editProses($id_guru,$data);
    // 3.jika sukses redirect ke route yang bernama guru
    // membuat var pesan 
    return redirect()->route('guru')->with('pesan','Edit data berhasil');
    }
    public function hapus($id_guru){
    // menghapus Foto
    $guru=$this->GuruModel->detailData($id_guru);
    // jika foto ada
    if($guru <>""){
        // foto dihapus
        unlink(public_path('foto_guru').'/'.$guru->foto_guru);
    }
    $this->GuruModel->hapusProses($id_guru);
    return redirect()->route('guru')->with('pesan','Hapus data berhasil');
    }

    // print to printer
    public function print(){
        $data=[
            'gurus'=>$this->GuruModel->tampil(),
        ];
        return view('v_printGuru',$data);
    }
    // print to printer
    public function printPDF(){
        // instantiate and use the dompdf class

        $data=[
            'gurus'=>$this->GuruModel->tampil(),
        ];
        $html= view('v_printPDFGuru',$data);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
    
}

