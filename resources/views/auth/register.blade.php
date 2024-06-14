@extends('welcome')

@section('body')

    <main class="container mt-3">
        <section class="my-5 row" style="padding: 80px ">
            <div class="col-lg-12 my-4">
                <p class="display-12 text-center">
                    <strong>S'inscrire</strong>
                </p>
                <form method="post" action="{{route('register')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom d'utilisateur</label>
                        <input type="text" id="nom" name="nom" class="w-100 my-1 border border-primary px-3"  style="outline: none;height: 40px "value="{{old('nom')}}">
                        @error('nom')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Addresse Email</label>
                        <input type="email" id="email" name="email" class="w-100 my-1 border border-primary px-3"  style="outline: none;height: 40px " value="{{old('email')}}">
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de Passe</label>
                        <input type="password" id="pass" name="password" class="w-100 my-1 border border-primary px-3"  style="outline: none;height: 40px " value="{{old('password')}}">
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pass2" class="form-label">Confirmation Mot de Passe</label>
                        <input type="password" id="pass2" name="password_confirmation" class="w-100 my-1 border border-primary px-3"  style="outline: none;height: 40px " value="{{old('password')}}">
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <p class="text-center my-3">
                        Deja un compte? <a href="{{route('login')}}">Se connecter</a>
                    </p>
                    <button type="submit" class="btn btn-primary w-100">Inscription</button>
                </form>
            </div>
        </section>
    </main>

@endsection
