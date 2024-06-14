@extends('welcome')

@section('body')
    <div class="container">
        <h1>Subscriptions</h1>
        <div>
            @session('success')
            <div class="alert alert-success">
                {{$value}}
            </div>
            @endsession
            <button type="button" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Create Subscription
            </button>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('subscriptions.index') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" >Nom subscription </label>
                                    <input type="text" class="form-control" name="name" id="exampleFormControlInput1" placeholder="..." value="{{old('name')}}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="montant" >Prix</label>
                                    <input type="number" class="form-control" name="montant" id="exampleFormControlInput1" placeholder="..." value="{{old('montant')}}">
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
                                        {{old('desc')}}
                                    </textarea>
                                    @error('desc')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="w-100 btn btn-primary">Creer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @forelse($subscriptions as $subscription)
        @empty
            <p class="mx-1 my-1">Aucune subscription disponible</p>
        @endforelse
        <table class="table mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Montant</th>
                <th>Description</th>
                <th>Subscription Type</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($subscriptions as $subscription)
                <tr>
                    <td>{{ $subscription->id }}</td>
                    <td>{{ $subscription->name }}</td>
                    <td>{{ $subscription->montant }}</td>
                    <td>{{ $subscription->desc }}</td>
                    <td>{{ $subscription->subscription_type }}</td>
                    <td>
                        <a href="{{route('subscriptions.edit',['id'=> $subscription->id])}}" class="btn btn-warning">
                           Edit
                        </a>
                        <span data-bs-toggle="modal" data-bs-target="#a{{$subscription->id}}" role="button" class="btn btn-danger">
                            Delete
                        </span>
                    </td>
                </tr>
                <div class="modal fade" id="a{{$subscription->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Voulez-vous vraiment supprimer <strong>{{$subscription->name}}</strong>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <a href="{{route('subscriptions.destroy',['id'=>$subscription->id])}}" class="btn btn-danger">Oui</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
