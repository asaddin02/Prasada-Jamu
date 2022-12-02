{{-- halaman view post --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                {{-- tombol untuk modal tambah --}}
                <a href="#" class="btn btn-sm btn-success mb-4 text-white" data-bs-toggle="modal"
                    data-bs-target="#tambah">Tambah</a>
                <table class="table table-bordered border-2">
                    <tr class="text-center text-white bg-dark">
                        <td>No</td>
                        <td>Judul</td>
                        <td>Isi</td>
                        <td>Penulis</td>
                        <td>Category</td>
                        <td>Tanggal di Tulis</td>
                        <td>Action</td>
                    </tr>
                    @foreach ($data as $d)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->judul }}</td>
                            <td>{{ $d->isi }}</td>
                            <td>{{ $d->penulis }}</td>
                            <td>{{ $d->category->namaKategori }}</td>
                            <td>{{ $d->tgl_dibuat }}</td>
                            <td>
                                {{-- tombol untuk modal edit --}}
                                <a href="#" class="btn btn-sm btn-primary text-white" data-bs-toggle="modal"
                                    data-bs-target="#edit{{ $d->id }}">Edit</a>

                                {{-- tombol untuk modal hapus --}}
                                <a href="#" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal"
                                    data-bs-target="#hapus{{ $d->id }}">Delete</a>
                            </td>
                        </tr>

                        {{-- modal hapus post --}}
                        <div class="modal fade" id="hapus{{ $d->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <b>{{ $d->judul }}</b>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('post.destroy', $d->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" class="btn btn-sm text-white btn-danger">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- modal ubah post --}}
                        <div class="modal fade" id="edit{{ $d->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('post.update', $d->id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="mb-3">
                                                <label class="col-form-label">Judul</label>
                                                <input type="text" class="form-control" name="judul"
                                                    value="{{ $d->judul }}">
                                                <label class="col-form-label">Isi</label>
                                                <input type="text" class="form-control" name="isi"
                                                    value="{{ $d->isi }}">
                                                <label class="col-form-label">Penulis</label>
                                                <input type="text" class="form-control" name="penulis"
                                                    value="{{ $user->name }}" readonly>
                                                <label class="col-form-label">Tanggal dibuat</label>
                                                <input type="date" class="form-control" name="tgl_dibuat"
                                                    value="{{ $d->tgl_dibuat }}">
                                                @if (Auth::user()->role == 'admin')
                                                    <label class="col-form-label">Kondisi</label>
                                                    <select name="kondisi" id="" class="form-control">
                                                        <option value="aktif">Aktif</option>
                                                        <option value="nonaktif">Non Aktif</option>
                                                    </select>
                                                @else
                                                    <input type="hidden" value="aktif" name="kondisi">
                                                @endif
                                                <label class="col-form-label">Kategori</label>
                                                <select name="category_id" id="" class="form-control">
                                                    <option value="{{ $d->category_id }}">Produk tidak diubah</option>
                                                    @foreach ($join as $j)
                                                        <option value="{{ $j->id }}">{{ $j->namaKategori }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" value="Edit" class="btn btn-sm text-white btn-primary">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </table>

                {{-- modal tambah post --}}
                <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('post.store') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="col-form-label">Judul</label>
                                        <input type="text" class="form-control" name="judul" required>
                                        <label class="col-form-label">Isi</label>
                                        <input type="text" class="form-control" name="isi" required>
                                        <label class="col-form-label">Penulis</label>
                                        <input type="text" class="form-control" name="penulis"
                                            value="{{ $user->name }}" readonly>
                                        <label class="col-form-label">Tanggal dibuat</label>
                                        <input type="date" class="form-control" name="tgl_dibuat" required>
                                        @if (Auth::user()->role == 'admin')
                                            <label class="col-form-label">Kondisi</label>
                                            <select name="kondisi" id="" class="form-control">
                                                <option value="aktif">Aktif</option>
                                                <option value="nonaktif">Non Aktif</option>
                                            </select>
                                        @else
                                            <input type="hidden" value="aktif" name="kondisi">
                                        @endif
                                        <label class="col-form-label">Kategori</label>
                                        <select name="category_id" id="" class="form-control" required>
                                            @foreach ($join as $j)
                                                <option value="{{ $j->id }}">{{ $j->namaKategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" value="Tambah" class="btn btn-sm text-white btn-success">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
