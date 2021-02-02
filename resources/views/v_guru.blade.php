@extends('layout.v_template')
@section('title','Guru')
    
@section('content')
{{-- cek data --}}
{{-- {{ dd($gurus) }} --}}
<a href="/guru/add" class="btn btn-primary">Tambah Guru</a>
<a href="/guru/print" class="btn btn-success" target="_blank">Print to Printer</a>
<a href="/guru/printPDF" class="btn btn-success" target="_blank">Print to PDF</a>
{{-- 5. var pesan akan diterima dalam bentuk session --}}
@if (session('pesan'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="false">&times;</button>
        <h4><i class="icon fa fa-check"></i>Success</h4>
        {{ session('pesan') }}        
    </div>
@endif
<table class="table table-borderless">
    <tr>
        <th>No</th>
        <th>NIP</th>
        <th>NAMA</th>
        <th>Mata Pelajaran</th>
        <th>Jam</th>
        <th>Foto</th>
        <th>Aksi</th>
    </tr>
@php ($no=1)    
@foreach ($gurus as $guru)
<tr>
    <td>{{ $no }}</td>
    <td>{{ $guru->nip_guru }} </td>
    <td>{{ $guru->nama_guru }} </td>
    <td>{{ $guru->mapel_guru }} </td>
    <td>{{ $guru->jam_pelajaran }} </td>
    <td><img src="{{ url('foto_guru/'.$guru->foto_guru) }}" width="100px"></td>
    <td>
        <a href="/guru/detail/{{ $guru->id_guru }}" class="btn btn-sm btn-success">Detail</a>
        <a href="/guru/edit/{{$guru->id_guru}}" class="btn btn-sm btn-warning">Edit</a>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus{{ $guru->id_guru }}">
            Hapus
        </button>
    </td>
</tr>
@php ($no++)
@endforeach
</table>
@foreach ($gurus as $guru)
<div class="modal modal-danger fade" id="hapus{{ $guru->id_guru }}" style="display: none;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">{{ $guru->nama_guru }}</h4>
        </div>
        <div class="modal-body">
          <p>Yakin ingin hapus?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
          <a href="/guru/hapus/{{ $guru->id_guru }}" class="btn btn-outline">Ya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  @endforeach

@endsection