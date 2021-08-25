@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" >{{ $title }}</div>

                <div class="card-body">
                    <form action="/company" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupFile01">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo_upload" value="{{ old('logo_upload') }}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Website</span>
                            <input type="text" class="form-control" name="website" value="{{ old('website') }}">
                        </div>
                        <div align="right">
                            <button type="submit" class="btn btn-secondary btn-sm">Tambah</button>
                            <a href="{{ url("/company") }}">
                                <button type="button" class="btn btn-secondary btn-sm">Batal</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection