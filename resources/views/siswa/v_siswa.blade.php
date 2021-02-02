@extends('layout.v_template')
@section('title','Siswa')
    
@section('content')
@if (session('pesan'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="false">&times;</button>
        <h4><i class="icon fa fa-check"></i>Success</h4>
        {{ session('pesan') }}        
    </div>
@endif
<a href="/siswa/tambah" class="btn btn-success">Tambah</a>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>NIS</th>
            <th>NAMA</th>
            <th>Jenis Kelamin</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>
        @php ($no=1)
        @foreach ($siswas as $siswa)
            <tr>
                <td>{{ $no }}</td>
                <td><a href="/siswa/detail/{{ $siswa->id_siswa }}"><img src="{{url('foto_siswa/'.$siswa->foto_siswa)}}" width="100"></a></td>
                <td><a href="/siswa/detail/{{ $siswa->id_siswa }}">{{ $siswa->nis_siswa }}</a></td>
                <td><a href="/siswa/detail/{{ $siswa->id_siswa }}">{{ $siswa->nama_siswa }}</a></td>
                <td><a href="/siswa/detail/{{ $siswa->id_siswa }}">{{ $siswa->jk_siswa }}</a></td>
                <td><a href="/siswa/detail/{{ $siswa->id_siswa }}">{{ $siswa->jurusan_siswa }}</a></td>
                <td>
                    <a href="/siswa/edit/{{ $siswa->id_siswa }}" class="btn btn-warning">Edit</a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus{{ $siswa->id_siswa }}">
                        Hapus
                      </button>
                </td>
            </tr>
        @php($no++)
        @endforeach
    </table>
@foreach ($siswas as $siswa)
<div class="modal modal-danger fade" id="hapus{{ $siswa->id_siswa }}" style="display: none;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">{{ $siswa->nama_siswa }}</h4>
        </div>
        <div class="modal-body">
          <p>apakah anda yakin ingin menghapus data?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
          <a href="/siswa/hapus/{{ $siswa->id_siswa }}" class="btn btn-outline">Ya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endforeach
@endsection