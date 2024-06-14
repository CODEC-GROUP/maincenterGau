@extends('welcome')

@section('body')
    <div class="container">
        <h1>Subscription</h1>
        <div>
            @session('success')
            <div class="alert alert-success">
                {{$value}}
            </div>
            @endsession
            <button type="button" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Do Subscription
            </button>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('subscriptions.show')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <select class="form-select" aria-label="Default select example" name="subscription_id">
                                        <option value="">Choisir un plan d abonnement</option>
                                        @foreach($subscriptions as $subscription)
                                            <option value="{{$subscription->id}}">{{$subscription->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('subscription_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <select class="form-select" aria-label="Default select example" name="user_id">
                                        <option value="">Choisir un utlisateur</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="w-100 btn btn-primary">Subscrire</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @forelse($plans as $plan)
        @empty
            <p class="mx-1 my-1">Aucun abonnement </p>
        @endforelse
        <table class="table mt-3 responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>Users</th>
                <th>Plans</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($plans as $plan)
                <tr>
                    <td>{{$plan->id}}</td>
                    <td>
                        @foreach($users as $user)
                            @if($plan->user_id == $user->id)
                                {{$user->name}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($subscriptions as $subscription)
                            @if($plan->subscription_id == $subscription->id)
                                {{$subscription->name}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <a href="{{route('subscriptions.change',['id'=> $plan->id])}}" class="btn btn-warning">
                            Edit
                        </a>
                        <span data-bs-toggle="modal" data-bs-target="#a{{$plan->id}}" role="button" class="btn btn-danger">
                            Delete
                        </span>
                    </td>
                </tr>
                <div class="modal fade" id="a{{$plan->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Voulez-vous vraiment supprimer le plan <strong>
                                    @foreach($subscriptions as $subscription)
                                        @if($plan->subscription_id == $subscription->id)
                                            {{$subscription->name}}
                                        @endif
                                    @endforeach
                                </strong> de  <strong>
                                    @foreach($users as $user)
                                        @if($plan->user_id == $user->id)
                                            {{$user->name}}
                                        @endif
                                    @endforeach
                                </strong>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <a href="{{route('subscriptions.cancel',['id'=>$plan->id])}}" class="btn btn-danger">Oui</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
