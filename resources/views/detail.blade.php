@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($data as $d)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">{{ __('Post') }}</div>

                        <div class="card-body">
                            <p><b>{{ $d->judul }}</b></p>
                            <p><b>{{ $d->isi }}</b></p>
                            <p><b>{{ $d->penulis }}</b></p>
                            <p><b>{{ $d->category->namaKategori }}</b></p>
                            <p><b>{{ $d->tgl_dibuat }}</b></p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('category.show'.$d->namaKategori) }}" class="btn btn-primary text-white">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
