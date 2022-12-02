{{-- tampilan halaman jamu --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card border border-2 border-info">
                    <div class="card-header">
                        <h4>Rekomendasi</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('jamu.store') }}" method="post">
                            @csrf
                            <label for="" class="form-label">Keluhan</label>
                            <input type="text" class="form-control" required name="keluhan">
                            <label for="" class="form-label">Tahun Kelahiran</label>
                            <input type="number" class="form-control" required name="tahun">
                            <input type="submit" value="Submit" class="btn btn-primary text-white">
                        </form>
                    </div>
                </div>
            </div>
            @isset($data)
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr class="text-center">
                            <td colspan="2" class="bg-dark text-white">Rekomendasi Jamu</td>
                        </tr>
                        <tr>
                            <th>Nama Jamu</th>
                            <td>{{ $data['nama'] }}</td>
                        </tr>
                        <tr>
                            <th>Khasiat</th>
                            <td>{{ $data['khasiat'] }}</td>
                        </tr>
                        <tr>
                            <th>Keluhan</th>
                            <td>{{ $data['keluhan'] }}</td>
                        </tr>
                        <tr>
                            <th>Umur</th>
                            <td>{{ $data['umur'] }}</td>
                        </tr>
                        <tr>
                            <th>Saran Penggunaan</th>
                            <td>{{ $data['saran'] }}</td>
                        </tr>
                    </table>
                </div>
            @endisset
        </div>
    </div>
@endsection
