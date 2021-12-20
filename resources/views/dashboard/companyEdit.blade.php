@extends('dashboard')
@section('title', 'Zmiana danych firmy')
@section('content')
<div class="container">
    <div class="card my-5">
        <div class="card-header">
            <h2>{{ $company->name }}</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Nazwa firmy</label>
                            <input class="form-control" name="name" type="text" value="{{ old('name', $company->name) }}"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Adres e-mail</label>
                            <input class="form-control" name="email" type="text" value="{{ old('email', $company->email) }}"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="website">Adres www</label>
                            <input type="date" class="form-control" name="website" value="{{ old('website', $company->website) }}"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="logo">Logo</label>
                        <input type="file" name="logo" class="form-control"/>
                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-primary">Zapis</button>
            </form>
        </div>
    </div>
    <form action="{{ route('company.destroy', $company->id) }}" method="POST">
        @method('DELETE')
        @csrf
        <p class="text-right">
            <button type="submit" class="btn btn-sm text-danger">Usunięcie firmy</button>
        </p>
    </form>
</div>
@endsection
