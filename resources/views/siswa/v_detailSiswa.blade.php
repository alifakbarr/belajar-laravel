@extends('layout.v_template')
@section('title','Detail Siswa')
@section('content')
    <table>
      <tr>
        <th>Foto</th>
        <td>:</td>
        <td><img src="{{url('foto_siswa/'.$siswa->foto_siswa) }}" width="200"></td>
      </tr>
      <tr>
        <th>NIS</th>
        <td>:</td>
        <td>{{ $siswa->nis_siswa }}</td>
      </tr>
      <tr>
        <th>NAMA</th>
        <td>:</td>
        <td>{{ $siswa->nama_siswa }}</td>
      </tr>
      <tr>
        <th>Jurusan</th>
        <td>:</td>
        <td>{{ $siswa->jurusan_siswa }}</td>
      </tr>
      <tr>
        <th>Jenis Kelamin</th>
        <td>:</td>
        <td>{{ $siswa->jk_siswa }}</td>
      </tr>
      <tr>
        <th>Tanggal Lahir</th>
        <td>:</td>
        <td>{{ $siswa->tanggalLahir_siswa }}</td>
      </tr>
      <tr>
        <th>Tempat Lahir</th>
        <td>:</td>
        <td>{{ $siswa->tempatLahir_siswa }}</td>
      </tr>
      <tr>
        <th>Alamat Siswa</th>
        <td>:</td>
        <td>{{ $siswa->alamat_siswa }}</td>
      </tr>
      <tr>
        <td>
          <a href="/siswa" class="btn btn-primary">Kembali</a>
        </td>
      </tr>
    </table>
@endsection