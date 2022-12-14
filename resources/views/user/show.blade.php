@extends('layouts.app')

@section('content')
    <div class="container-fluid panel__text-container">

        <div class="crud__info-wrapper">
            <h1 class="text-black panel__welcome-header">
                Profil użytkownika
                <img src="{{ Storage::url($user->image_path) }}" class="panel__user-image" alt="User image">
                {{ $user->name }} {{ $user->surname }}
            </h1>

            @if (Auth::user()->hasRole('admin'))
                <a href="{{ route('user.edit', $user->id) }}" class="crud__button">
                Edytuj
                </a>

                <form method="post" action="/user/{{ $user->id }}">
                    @method('DELETE')
                    @csrf
                    
                    <button class="button button__submit button__submit--delete">
                        Usuń
                    </button>
                </form>
            @endif
        </div>

        <h2>
            E-mail: {{ $user->email }}
        </h2>

        <h2>
            Numer telefonu: {{ $user->phone_number }}
        </h2>

        <h2>
            Rola: {{ $user->getRoleNames()[0] }}
        </h2>

        <h2>
            Pracownik należy do działów: 
            @foreach($user->departments as $department)
            <a href="{{ route('department.show', $department->id) }}">
                {{ $department->name }};
            </a>
            @endforeach
        </h2>

        <h2>
            Razem działów: {{ $user->departments->count() }}
        </h2>

        <h2>
            Opis pracownika
        </h2>
        <p>
            {{ $user->description }}
        </p>

        <a href="{{ route('user.index') }}">Przejdź do listy pracowników</a>
        <a href="{{ route('department.index') }}">Przejdź do listy działów</a>
        <a href="{{ route('home.index') }}">Przejdź do panelu</a>

    </div>
@endsection
