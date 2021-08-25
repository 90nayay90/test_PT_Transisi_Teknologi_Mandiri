@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $title }}</div>
                    <div class="card-body">
                        <a class="btn btn-primary mb-3" href="/company/create" role="button">Add Company</a>

                        <form action="/company">
                            <div class="input-group mb-1">
                                <input type="text" class="form-control" placeholder="Search.." name="search">
                                <button class="btn btn-outline-dark" type="submit">Search</button>
                            </div>
                        </form>

                        <div class="list-group">
                            @foreach ($company as $item)
                                <div class="container">
                                    <div class="row">
                                        <a href="/company/{{ $item['id'] }}/edit">
                                            <button type="submit" style="margin-right: 10px">Edit</button>
                                        </a>
                                        <form action="/company/{{ $item['id'] }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <a href="/company/{{ $item['id'] }}" class="list-group-item list-group-item-action" aria-current="true">
                                    <?php
                                        $path = Storage::url('app/company/tes.png');
                                        $total_employee = count(DB::table('employees')->where('company_id', $item['id'])->get());
                                    ?>
                                    <img src="{{ asset('storage/app/company/'. $item->logo) }}" alt="" title="" width="100px" height="100ox">

                                    <img src="{{ Storage::put('app.company', $item->logo); }}" alt="">

                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $item["name"] }} </h5>
                                        <small>Employee : {{ $total_employee }}</small>
                                    </div>
                                    <div>
                                        {{ $item['email'] }}
                                    </div>
                                    <small style="font-style:italic;">{{ $item['website'] }}</small>
                                </a>
                            @endforeach
                        </div>

                        {{-- untuk pagination --}}
                            {{ $company->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection