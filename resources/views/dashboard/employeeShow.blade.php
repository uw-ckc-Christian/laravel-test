@extends('dashboard')
@section('title', 'Podgląd pracownika')
@section('content')
<div class="container">
    <div class="card my-5">
        <div class="card-header">
            <h2>{{ $employee->first_name }} {{ $employee->last_name }}</h2>
        </div>
        <div class="card-body">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="card-title">
                            <p>{{ ( $employee->email !== null ) ? $employee->email : '' }}</p>
                            <p>{{ ( $employee->phone !== null ) ? $employee->phone : '' }}</p>
                        </h3>
                        <p>
                            <a href="/dashboard/company/{{ $employee->company->id }}">{{ $employee->company->name }}</a>
                        </p>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="/dashboard/employee/{{ $employee->id }}/edit" class="btn btn-sm btn-success">Zmiana danych pracownika</a>
                    <form action="{{ route('employee.destroy', $employee->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Usunięcie pracownika</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
