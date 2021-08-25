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
                    <form action="/employee/{{ $employee->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                            <input type="text" class="form-control" name="name" value="{{ $employee->name }}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
                            <input type="text" class="form-control" name="email" value="{{ $employee->email }}">
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01" style="width: 15%">Options</label>
                            <select class="form-select" id="company" style="width:85%" name="company">
                                @foreach ($company as $data_company)
                                    <option {{ ($employee->company_id == $data_company->id) ? "selected":'' }} value="{{ $data_company->id }}">{{ $data_company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div align="right">
                            <button type="submit" class="btn btn-secondary btn-sm">Edit</button>
                            <a href="{{ url("/employee") }}">
                                <button type="button" class="btn btn-secondary btn-sm">Batal</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection