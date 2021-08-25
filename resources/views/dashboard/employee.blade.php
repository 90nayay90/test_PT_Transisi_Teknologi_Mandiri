@extends('layouts.app')

@section('content')
    <h1 align="center" class="mb-5">Employee</h1>

    <a href="/employee/create">
        <button type="button" class="btn btn-primary mb-2">Add Employee</button>
    </a>

    <form action="/employee">
        <div class="input-group mb-1">
            <input type="text" class="form-control" placeholder="Search.." name="search">
            <button class="btn btn-outline-dark" type="submit">Search</button>
        </div>
    </form>

    <table class="table table-striped">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Company</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        @foreach ($employee as $item)
            <?php
                $company = DB::table('companies')->where('id', $item['company_id'])->get();
            ?>
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item['name'] }}</td>
                <td>
                @foreach ($company as $item_company)
                    {{ $item_company->name }}
                @endforeach
                </td>
                <td>{{ $item['email'] }}</td>
                <td>
                    <div class="container">
                        <div class="row">
                            <a href="/employee/{{ $item->id }}/edit">
                                <button type="Submit" class="btn btn-warning" style="margin-right: 10px">Edit</button>
                            </a>
                            <form action="/employee/{{ $item->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <button type="Submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    {{-- pagination --}}
    {{ $employee->links() }}
@endsection