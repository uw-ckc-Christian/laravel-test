@extends('dashboard')
@section('title', 'Podgląd firmy')
@section('content')
<div class="container">
    <div class="card my-5">
        <div class="card-header">
            <h2>{{ $company->name }}</h2>
        </div>
        <div class="card-body">
            <div class="card-body">
                <div class="row">
                    @if ( $company->logo !== null )
                    <div class="col-sm-6">
                        <img src="{{ asset('storage/' . $company->logo ) }}" class="img-fluid" alt="{{ $company->name }} logo">
                    </div>
                    @endif
                    <div class="col-sm-6">
                        <h3 class="card-title">
                            <p>{{ ( $company->email !== null ) ? $company->email : '' }}</p>
                            <p>{{ ( $company->website !== null ) ? $company->website : '' }}</p>
                        </h3>
                        Lista pracowników:
                        <ul>
                        @foreach( $company->employees as $employee )
                            <li>
                                <a href="/dashboard/employee/{{ $employee->id }}">
                                    {{ $employee->first_name }} {{ $employee->last_name }}
                                </a>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="/dashboard/company/{{ $company->id }}/edit" class="btn btn-sm btn-success">Zmiana danych firmy</a>
                    <form action="{{ route('company.destroy', $company->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Usunięcie firmy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
