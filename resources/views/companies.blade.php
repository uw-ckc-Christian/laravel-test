@extends('dashboard')
@section('title', 'Firmy')
@section('content')
<div class="container my-5">
    <p>
        <a href="/dashboard/company/create" class="btn btn-primary">Nowa firma</a>
    </p>
    <div class="row">
        @foreach ($companies as $company)
        <div class="col-sm-4">
            <div class="card mb-3">
                <div style="background-image:url('{{ asset('storage/' . $company->logo ) }}');height:100px;background-size:cover;" class="img-fluid" alt=""></div>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/dashboard/company/{{ $company->id }}">{{ $company->name }}</a>
                    </h5>
                    <small class="text-muted">
                        {{ $company->website }}<br/>{{ $company->email }}
                    </small>
                    <a href="/dashboard/company/{{ $company->id }}/edit" class="btn btn-primary">Zmiana</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{ $companies->links() }}
</div>
@endsection
