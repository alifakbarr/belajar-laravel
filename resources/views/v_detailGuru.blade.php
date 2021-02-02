@extends('layout.v_template')
@section('title','Detail Guru')
@section('content')
    <table class="table">
      <thead>
        <th>NIP</th>
        <th>NAMA</th>
        <th>Mata Pelajaran</th>
        <th>Jam Pelajarab</th>
        <th>Foto</th>
      </thead>
      <tbody>
          <tr>
            <td>{{ $guru->nip_guru }} </td>
            <td>{{ $guru->nama_guru }} </td>
            <td>{{ $guru->mapel_guru }} </td>
            <td>{{ $guru->id_jam }} </td>
            <td><img src="{{ url('foto_guru/'.$guru->foto_guru) }}" width="100px"></td>
          </tr>
      </tbody>

    </table>
    <a href="/guru" class="btn btn-sm btn-primary">Kembali</a>
@endsection