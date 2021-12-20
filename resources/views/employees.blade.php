@extends('dashboard')
@section('title', 'Pracownicy')
@section('content')
<div class="container mt-5">
    <h2>Pracownicy</h2>
    <p>
        <a href="/dashboard/employee/create" class="btn btn-primary">Nowy pracownik</a>
    </p>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Firma</th>
                <th>Adres e-mail</th>
                <th>Numer telefonu</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $employees as $employee )
            <tr>
                <td><a href="/dashboard/employee/{{ $employee->id }}">{{ $employee->first_name }}</a></td>
                <td><a href="/dashboard/employee/{{ $employee->id }}">{{ $employee->last_name }}</a></td>
                <td>
                @if ( $employee->company !== null )
                    <a href="/dashboard/company/{{ $employee->company->id }}">{{ $employee->company->name }}</a>
                @else
                    &nbsp;
                @endif
                </td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                <td>
                    <a href="/dashboard/employee/{{ $employee->id }}/edit" class="btn btn-sm btn-success">Zmiana</a>
                    <br/>
                    <form action="{{ route('employee.destroy', $employee->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <p>
                            <button type="submit" class="btn btn-sm btn-danger">Usunięcie</button>
                        </p>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $employees->links() }}
</div>
@endsection
