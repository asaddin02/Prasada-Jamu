{{-- halaman view user --}}
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
                        <td>Nama</td>
                        <td>Email</td>
                        <td>Role</td>
                        <td>Password</td>
                        <td>Action</td>
                    </tr>
                    @foreach ($data as $d)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->email }}</td>
                            <td>{{ $d->role }}</td>
                            <td>{{ $d->password }}</td>
                            <td>
                                {{-- tombol untuk modal edit --}}
                                <a href="#" class="btn btn-sm btn-primary text-white" data-bs-toggle="modal"
                                    data-bs-target="#edit{{ $d->id }}">Edit</a>

                                {{-- tombol untuk modal hapus --}}
                                <a href="#" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal"
                                    data-bs-target="#hapus{{ $d->id }}">Delete</a>
                            </td>
                        </tr>

                        {{-- modal hapus user --}}
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
                                        <b>{{ $d->name }}</b>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('user.destroy', $d->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" class="btn btn-sm text-white btn-danger">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- modal ubah user --}}
                        <div class="modal fade" id="edit{{ $d->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('user.update', $d->id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="mb-3">
                                                <label class="col-form-label">Nama</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ $d->name }}">
                                                <label class="col-form-label">Email</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ $d->email }}">
                                                <label class="col-form-label">Role</label>
                                                <select name="role" id="" class="form-control">
                                                    <option value="{{ $d->role }}">Posisi Tidak di Ubah</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="editor">Editor</option>
                                                </select>
                                                <label class="col-form-label">Password</label>
                                                <input type="password" class="form-control" name="password"
                                                    value="{{ $d->password }}">
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

                {{-- modal tambah user --}}
                <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('user.store') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="col-form-label">Nama</label>
                                        <input type="text" class="form-control" name="name" required>
                                        <label class="col-form-label">Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                        <label class="col-form-label">Role</label>
                                        <select name="role" id="" class="form-control" required>
                                            <option value="admin">Admin</option>
                                            <option value="editor">Editor</option>
                                        </select>
                                        <label class="col-form-label">Password</label>
                                        <input type="password" class="form-control" name="password" required>
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
