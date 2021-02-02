<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SiswaModel extends Model
{
    public function tampil(){
        return DB::table('siswa')->get();
    }
    public function detailData($id_siswa){
        return DB::table('siswa')->where('id_siswa',$id_siswa)->first();
    }
    public function prosesSiswa($data){
        DB::table('siswa')->insert($data);
    }

    public function editSiswa($id_siswa,$data){
        DB::table('siswa')->where('id_siswa',$id_siswa)->update($data);
    }
    public function prosesHapus($id_siswa){
        DB::table('siswa')->where('id_siswa',$id_siswa)->delete();
    }

}
