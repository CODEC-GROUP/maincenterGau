@extends('welcome')

@section('body')
    <main class="container-fluid mt-3">
        <section class="row">
            <div class="col-10">
                <form action="{{route('subscriptions.edit',['id'=>$subscriptions->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" >Nom subscription </label>
                        <input type="text" class="form-control" name="name" id="exampleFormControlInput1" placeholder="..." value="{{$subscriptions->name}}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="montant" >Prix</label>
                        <input type="number" class="form-control" name="montant" id="exampleFormControlInput1" placeholder="..." value="{{$subscriptions->montant}}">
                        @error('montant')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="subscription_type">
                            <option value="">Choisir une option d abonnement</option>
                            <option value="30 Days">Mensuelle</option>
                            <option value="1 Years">Annuelle</option>
                        </select>
                        @error('subscription_type')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <textarea name="desc" class="form-control" placeholder="Description" cols="3" >
                            {{$subscriptions->desc}}
                        </textarea>
                        @error('desc')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <button type="submit" class="w-100 btn btn-primary">Modifier cette subscription</button>
                </form>
            </div>
        </section>
    </main>
@endsection
