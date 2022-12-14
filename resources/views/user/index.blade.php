@extends('layouts.app')

@section('content')
    <div class="container-fluid panel__text-container">

        
        <h1 class="text-black panel__welcome-header">
            Lista użytkowników
        </h1>

        <form class="form-inline" method="GET">
            <div class="form-group mb-2">
            <input type="text" class="form-control" id="filter" name="filter" placeholder="Przeszukaj użytkowników" value="{{$filter}}">
            </div>
            <button type="submit" class="btn btn-default mb-2">Wyszukaj</button>
        </form>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col" class="table__header">@sortablelink('id', 'ID')</th>
                    <th scope="col" class="table__header">@sortablelink('name', 'Imię')</th>
                    <th scope="col" class="table__header">@sortablelink('surname', 'Nazwisko')</th>
                    <th scope="col" class="table__header">@sortablelink('email', 'Email')</th>
                    <th scope="col" class="table__header">Numer telefonu</th>
                    <th scope="col" class="table__header">Opis</th>
                    <th scope="col" class="table__header">Rola</th>
                    <th scope="col" class="table__header">Ilość działów</th>
                    <th scope="col" class="table__header">Działy</th>
                    <th scope="col" class="table__header">@sortablelink('created_at', 'Data stworzenia')</th>
                    <th scope="col" class="table__header">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @if ($users->count() == 0)
                <tr>
                    <td colspan="5">Brak użytkowników do wyświetlenia</td>
                </tr>
                @endif

                @forelse ($users as $user)
                <tr>
                    <th scope="row" class="table__cell">
                        {{ $user->id }}
                    </th>
    
                    <td class="table__cell table__cell--important">
                        {{ $user->name }}
                    </td>

                    <td class="table__cell table__cell--important">
                        {{ $user->surname }}
                    </td>
    
                    <td class="table__cell table__cell--important">
                        <a href="{{ route('user.show', $user->id) }}">
                            {{ $user->email }}
                        </a>
                    </td>

                    <td class="table__cell table__cell--important">
                        {{ $user->phone_number }}
                    </td>

                    <td class="table__cell table__cell--important">
                        {{ $user->description }}
                    </td>

                    <td class="table__cell">
                        {{ $user->getRoleNames()[0] }}
                    </td>

                    <td class="table__cell">
                        {{ $user->departments_count }}
                    </td>

                    <td class="table__cell">
                        @foreach($user->departments as $department)
                        <a href="{{ route('department.show', $department->id) }}">
                            {{ $department->name }};
                        </a>
                        <br>
                        @endforeach
                    </td>

                    <td class="table__cell">
                        {{ $user->created_at->format('Y-m-d') }}
                    </td>
    
                    <td class="table__cell">
                        <div class="table__actions-wrapper">
                            @if (Auth::user()->hasRole('admin'))
                            <a href="{{ route('user.edit', $user->id) }}">
                            Edytuj
                            </a>

                            <form method="post" action="{{ route('user.destroy', $user->id) }}">
                                @method('DELETE')
                                @csrf
                                
                                <button class="button button__submit button__submit--delete button__submit--small">
                                    Usuń
                                </button>
                            </form>
                            @else
                            <a href="{{ route('user.show', $user->id) }}">
                            Podgląd
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>

        {{ $users->withQueryString()->links() }}

    </div>
@endsection
