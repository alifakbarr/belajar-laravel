@extends('layout.v_template')
@section('title','Edit Guru')
    
@section('content')
<form action="/guru/prosesEdit/{{ $guru->id_guru }}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="content">
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          {{-- old untuk menampilkan value lama --}}
          <label for="nip_guru">NIP</label>
          <input type="text" name="nip_guru" id="nip_guru" class="form-control" value="{{ $guru->nip_guru}}" readonly>
          {{-- jika form tidak diisi --}}
          @error('nip_guru')
              <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="nama_guru">Nama</label>
          <input type="text" name="nama_guru" id="nama_guru" class="form-control" value="{{ $guru->nama_guru }}">
          @error('nama_guru')
              <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="mapel_guru">Mata Pelajaran</label>
          <input type="text" name="mapel_guru" id="mapel_guru" class="form-control" value="{{ $guru->mapel_guru}}">
          <div class="text-danger">
            @error('mapel_guru')
              {{ $message }}
            @enderror 
          </div>
          
        </div>
        <div class="form-group">
          <label for="id_jam">Jam Pelajaran</label>
          <select name="id_jam" id="id_jam" class="form-control">
            <option value="1">Pagi</option>
            <option value="2">Siang</option>
          </select>

          <div class="text-danger">
            @error('id_jam')
              {{ $message }}
            @enderror 
          </div>
          
        </div>
        <div class="form-group">
          <img src="{{ url('foto_guru/'.$guru->foto_guru) }}" width="150px">
        </div>
        <div class="form-group">
          <label for="foto_guru">Foto</label>
          <input type="file" name="foto_guru" id="foto_guru" class="form-control" value="{{ $guru->foto_guru }}">
          @error('foto_guru')
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