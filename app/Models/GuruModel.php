<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GuruModel extends Model
{
    public function tampil(){
        return DB::table('guru')
        ->leftJoin('jam','jam.id_jam','=','guru.id_jam')->get();
    }

    public function detailData($id_guru){
        return DB::table('guru')->where('id_guru',$id_guru)->first();
    }

    //1. menerima data dari GuruController
    public function prosesGuru($data){
        // input data
        DB::table('guru')->insert($data);
    }
    public function editProses($id_guru,$data){
        DB::table('guru')->where('id_guru',$id_guru)->update($data);

    }
    public function hapusProses($id_guru){
        DB::table('guru')->where('id_guru',$id_guru)->delete();
    }
}
