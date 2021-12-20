@extends('dashboard')
@section('title', 'Zmiana danych pracownika')
@section('content')
<div class="container my-5">
    <div class="card">
        <div class="card-header">
            <h2>{{ $employee->first_name }} {{ $employee->last_name }}</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('employee.update', $employee->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="name">Imię</label>
                            <input class="form-control" name="first_name" type="text" value="{{ old('first_name', $employee->first_name) }}"/>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="name">Nazwisko</label>
                            <input class="form-control" name="last_name" type="text" value="{{ old('last_name', $employee->last_name) }}"/>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="company_id">Firma</label>
                            <select class="form-control" name="company_id" value="">
                                <option value=""></option>
                                @foreach( $companies as $option )
                                    <option value="{{ $option->id }}"
                                    {{ ( $option->id === old('company_id', $employee->company_id) ) ? ' selected="selected"' : '' }}
                                    >{{ $option->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="email">Adres e-mail</label>
                            <input class="form-control" name="email" type="text" value="{{ old('email', $employee->email) }}"/>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="phone">Numer telefonu</label>
                            <input type="date" class="form-control" name="phone" value="{{ old('phone', $employee->phone) }}"/>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-primary">Zapis</button>
            </form>

            <form action="{{ route('employee.destroy', $employee->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <p class="text-right">
                    <button type="submit" class="btn btn-sm text-danger">Usunięcie pracownika</button>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
