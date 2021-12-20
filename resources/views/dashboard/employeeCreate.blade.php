@extends('dashboard')
@section('title', 'Nowy pracownik')
@section('content')
<div class="container my-5">
    <div class="card">
        <div class="card-header">
            <h2>Nowy pracownik</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('employee.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="name">Imię</label>
                            <input class="form-control" name="first_name" type="text"/>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="name">Nazwisko</label>
                            <input class="form-control" name="last_name" type="text"/>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="company_id">Firma</label>
                            <select class="form-control" name="company_id">
                                <option value=""></option>
                                @foreach( $companies as $option )
                                    <option value="{{ $option->id }}">{{ $option->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="email">Adres e-mail</label>
                            <input class="form-control" name="email" type="text"/>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="phone">Numer telefonu</label>
                            <input type="date" class="form-control" name="phone"/>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-primary">Zapis</button>
            </form>
        </div>
    </div>
</div>
@endsection
