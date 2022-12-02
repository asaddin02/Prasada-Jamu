{{-- halaman view category --}}
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
                        <td>Category</td>
                        <td>Deskripsi</td>
                        <td>Action</td>
                    </tr>
                    @foreach ($data as $d)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->namaKategori }}</td>
                            <td>{{ $d->descKategori }}</td>
                            <td>
                                {{-- tombol untuk modal edit --}}
                                <a href="#" class="btn btn-sm btn-primary text-white" data-bs-toggle="modal"
                                    data-bs-target="#edit{{ $d->id }}">Edit</a>

                                {{-- tombol untuk modal hapus --}}
                                <a href="#" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal"
                                    data-bs-target="#hapus{{ $d->id }}">Delete</a>
                            </td>
                        </tr>

                        {{-- modal hapus kategori --}}
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
                                        <b>{{ $d->namaKategori }}</b>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('category.destroy', $d->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" class="btn btn-sm text-white btn-danger">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- modal ubah kategori --}}
                        <div class="modal fade" id="edit{{ $d->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('category.update', $d->id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="mb-3">
                                                <label class="col-form-label">Nama Kategori</label>
                                                <input type="text" class="form-control" name="namaKategori"
                                                    value="{{ $d->namaKategori }}">
                                                <label class="col-form-label">Deskripsi Kategori</label>
                                                <input type="text" class="form-control" name="descKategori"
                                                    value="{{ $d->descKategori }}">
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

                {{-- modal tambah kategori --}}
                <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('category.store') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="col-form-label">Nama Kategori</label>
                                        <input type="text" class="form-control" name="namaKategori" required>
                                        <label class="col-form-label">Deskripsi Kategori</label>
                                        <input type="text" class="form-control" name="descKategori" required>
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
