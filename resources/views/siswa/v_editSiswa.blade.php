@extends('layout.v_template')
@section('title','Edit Siswa')
    
@section('content')
<form action="/siswa/prosesEdit/{{ $siswa->id_siswa }}" method="post" enctype="multipart/form-data">
  @csrf
<div class="content">
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="nis_siswa">NIS</label>
        <input type="text" name="nis_siswa" id="nis_siswa"class="form-control" value="{{ $siswa->nis_siswa }}" readonly>
        @error('nis_siswa')
            <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="nama_siswa">Nama</label>
        <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" value="{{ $siswa->nama_siswa }}">
        @error('nama_siswa')
            <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="jk_siswa">Jenis Kelamin</label>
        <input type="radio" name="jk_siswa" id="l" value="L"><label for="l">L</label>
        <input type="radio" name="jk_siswa" id="p" value="P"><label for="p">P</label>
        @error('jk_siswa')
            <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="tanggalLahir_siswa">Tanggal Lahir</label>
        <input type="date" name="tanggalLahir_siswa" id="tanggalLahir_siswa" class="form-control" value="{{ $siswa->tanggalLahir_siswa }}">
        @error('tanggalLahir_siswa')
            <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="tempatLahir_siswa">Tempat Lahir</label>
        <input type="text" name="tempatLahir_siswa" id="tempatLahir_siswa" class="form-control" value="{{ $siswa->tempatLahir_siswa }}">
        @error('tempatLahir_siswa')
            <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="jurusan_siswa">Jurusan</label>
        <select name="jurusan_siswa" id="jurusan_siswa" class="form-control" value="{{ $siswa->jurusan_siswa }}">
          <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
          <option value="Teknik Mesin">Tenik Mesin</option>
          <option value="Multimedia">Multimedia</option>
        </select>
        @error('jurusan_siswa')
            <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="alamat_siswa" >Alamat</label>
        <textarea name="alamat_siswa" id="alamat_siswa" cols="30" rows="5" class="form-control"> {{$siswa->alamat_siswa }}</textarea>
        @error('alamat_siswa')
            <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <img src="{{ url('foto_siswa/'.$siswa->foto_siswa) }}" width="150px">
      </div>
      <div class="form-group">
        <label for="foto_siswa">Foto</label>
        <input type="file" name="foto_siswa" id="foto_siswa"class="form-control" value="{{ $siswa->foto_siswa }}">
            @error('foto_siswa')
            <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <button class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>
</form>
@endsection