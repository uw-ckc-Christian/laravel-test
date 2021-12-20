@extends('dashboard')
@section('title', 'Nowa firma')
@section('content')
<div class="container my-5">
    <div class="card">
        <div class="card-header">
            <h2>Nowa firma</h2>
        </div>
        @if(!empty(Session::get('success')))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif

        @if( $errors->any() )
        <div class="alert alert-danger">
            <ul>
            @foreach( $errors->all() as $error )
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif

        <div class="card-body">
            <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Nazwa firmy</label>
                            <input class="form-control" name="name" type="text"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Adres e-mail</label>
                            <input class="form-control" name="email" type="text"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="website">Adres www</label>
                            <input type="date" class="form-control" name="website"/>
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
</div>
@endsection
