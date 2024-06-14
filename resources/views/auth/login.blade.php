@extends('welcome')

@section('body')

    <main class="container mt-3">
        <section class="my-5 row" style="padding: 80px ">
            <div class="col-lg-12 my-4">
                <p class="display-12 text-center">
                    <strong>Se Connecter</strong>
                </p>
                <form  method="post" action="{{route('login')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label "> Adresse Email</label>
                        <input type="email" id="email" name="email" placeholder="name@example.com" class="w-100 my-1 border border-primary px-3"  style="outline: none;height: 40px " value="{{old('email')}}">
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Mot de Passe</label>
                        <input type="password" id="pass" name="password" style="outline: none;height: 40px " class="w-100 px-3 my-1 border border-primary" value="{{old('password')}}">
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <p class="text-center">
                        pas de  compte? <a href="{{route('register')}}">S'inscrire</a>
                    </p>
                    <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                </form>
            </div>
        </section>
    </main>

@endsection
