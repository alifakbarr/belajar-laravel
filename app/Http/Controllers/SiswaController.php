<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiswaModel;

class SiswaController extends Controller
{
    public function __construct() {
        $this->SiswaModel=new SiswaModel();
        // agar user login dulu
        $this->middleware('auth');
    }
    public function index(){
        $data=['siswas'=>$this->SiswaModel->tampil(),];
        return view('siswa.v_siswa',$data);
    }

    public function detail($id_siswa){
        if(!$this->SiswaModel->detailData($id_siswa)){
            abort(404);
        }
        $data=['siswa'=>$this->SiswaModel->detailData($id_siswa),];
        return view('siswa.v_detailSiswa',$data);
    }

    public function tambah(){
        return view('siswa.v_tambahSiswa');
    }

    public function validasiSiswa(){
        // validasi
        Request()->validate([
            'nis_siswa'=>'required|min:4|max:5|unique:siswa,nis_siswa',
            'nama_siswa'=>'required',
            'jk_siswa'=>'required',
            'tanggalLahir_siswa'=>'required',
            'tempatLahir_siswa'=>'required',
            'jurusan_siswa'=>'required',
            'alamat_siswa'=>'required',
            'foto_siswa'=>'required|mimes:jpg,bmp,png,jpeg|max:2024'
        ],
        // pesan error
        [
            'nis_siswa.required'=>'Wajib isi',
            'nis_siswa.min'=>'Minimal 4 karakter',
            'nis_siswa.max'=>'Maksimal 5 karakter',
            'nis_siswa.unique'=>'NIS sudah ada',
            'nama_siswa.required'=>'Wajib isi',
            'jk_siswa.required'=>'Wajib isi',
            'tanggalLahir_siswa.required'=>'Wajib isi',
            'tempatLahir_siswa.required'=>'Wajib isi',
            'jurusan_siswa.required'=>'Wajib isi',
            'alamat_siswa.required'=>'Wajib isi',
            'foto_siswa.required'=>'Wajib isi',
            'foto_siswa.mimes'=>'Hanya jpg,jpeg,png yang diupload',
            'foto_siswa.max'=>'Maksimal 2mb',

        ]);

        $file=Request()->foto_siswa;
        $fileName=Request()->nis_siswa.'.'.$file->extension();
        $file->move(public_path('foto_siswa'),$fileName);

        $data=[
            'nis_siswa'=>Request()->nis_siswa,
            'nama_siswa'=>Request()->nama_siswa,
            'jk_siswa'=>Request()->jk_siswa,
            'tanggalLahir_siswa'=>Request()->tanggalLahir_siswa,
            'tempatLahir_siswa'=>Request()->tempatLahir_siswa,
            'jurusan_siswa'=>Request()->jurusan_siswa,
            'alamat_siswa'=>Request()->alamat_siswa,
            'foto_siswa'=>$fileName
        ];

        // kirim ke proses siswa
        $this->SiswaModel->prosesSiswa($data);
        return redirect()->route('siswa')->with('pesan','Tambah data berhasil');

    }

    public function edit($id_siswa){
        if(!$this->SiswaModel->detailData($id_siswa)){
            abort(404);
        }
        $siswa=['siswa'=>$this->SiswaModel->detailData($id_siswa),];
        return view('siswa.v_editSiswa',$siswa);
    }
    public function prosesEdit($id_siswa){
        // validasi
        Request()->validate([
            'nis_siswa'=>'min:4|max:5|',
            'nama_siswa'=>'required',
            'jk_siswa'=>'required',
            'tanggalLahir_siswa'=>'required',
            'tempatLahir_siswa'=>'required',
            'jurusan_siswa'=>'required',
            'alamat_siswa'=>'required',
            'foto_siswa'=>'mimes:jpg,bmp,png,jpeg|max:2024'
        ],
        // pesan error
        [

            'nis_siswa.min'=>'Minimal 4 karakter',
            'nis_siswa.max'=>'Maksimal 5 karakter',
            'nama_siswa.required'=>'Wajib isi',
            'jk_siswa.required'=>'Wajib isi',
            'tanggalLahir_siswa.required'=>'Wajib isi',
            'tempatLahir_siswa.required'=>'Wajib isi',
            'jurusan_siswa.required'=>'Wajib isi',
            'alamat_siswa.required'=>'Wajib isi',
            'foto_siswa.mimes'=>'Hanya jpg,jpeg,png yang diupload',
            'foto_siswa.max'=>'Maksimal 2mb',

        ]);
        // jika foto siswa tidak kosong
        if(Request()->foto_siswa<>""){
        $file=Request()->foto_siswa;
        $fileName=Request()->nis_siswa.'.'.$file->extension();
        $file->move(public_path('foto_siswa'),$fileName);

        $data=[
            'nis_siswa'=>Request()->nis_siswa,
            'nama_siswa'=>Request()->nama_siswa,
            'jk_siswa'=>Request()->jk_siswa,
            'tanggalLahir_siswa'=>Request()->tanggalLahir_siswa,
            'tempatLahir_siswa'=>Request()->tempatLahir_siswa,
            'jurusan_siswa'=>Request()->jurusan_siswa,
            'alamat_siswa'=>Request()->alamat_siswa,
            'foto_siswa'=>$fileName
        ];
        }else{

        $data=[
            'nis_siswa'=>Request()->nis_siswa,
            'nama_siswa'=>Request()->nama_siswa,
            'jk_siswa'=>Request()->jk_siswa,
            'tanggalLahir_siswa'=>Request()->tanggalLahir_siswa,
            'tempatLahir_siswa'=>Request()->tempatLahir_siswa,
            'jurusan_siswa'=>Request()->jurusan_siswa,
            'alamat_siswa'=>Request()->alamat_siswa,
        ];
        }

        // kirim ke proses siswa
        $this->SiswaModel->editSiswa($id_siswa,$data);
        return redirect()->route('siswa')->with('pesan','Edit data berhasil');

    }

    public function hapus($id_siswa){
        $siswa=$this->SiswaModel->detailData($id_siswa);
        if($siswa<>""){
            unlink(public_path('foto_siswa').'/'.$siswa->foto_siswa);
        }
        $this->SiswaModel->prosesHapus($id_siswa);

        return redirect()->route('siswa')->with('pesan','Hapus data berhasil');
    }
}
