@extends('welcome')

@php
    use Carbon\Carbon;
@endphp

@section('body')

    <div class="container ">
        <h1 class="text-center fw-bold my-2">Plan disponible</h1>
        @session('success')
        <div class="alert alert-success">
            {{$value}}
        </div>
        @endsession
        <div class="row">
            <div class="col-4">
                <h3>Vos abonnements</h3>
                @forelse($plans as $plan)
                    <ol class="my-4 mx-2">
                        <li>
                            <strong>
                                @foreach($subscriptions as $subscription)
                                    @if($plan->subscription_id == $subscription->id)
                                        {{$subscription->name}}
                                        <small>valable pendant {{$subscription->subscription_type}} </small>
                                    @endif
                                @endforeach
                            </strong>payé le
                            <strong>
                                @php
                                    $dt = Carbon::parse($plan->created_at)->locale('fr');
                                    echo $dt->translatedFormat('l j F Y à H:i:s ');
                                @endphp
                            </strong>
                            <a href="{{route('subscriptions.changeU',['id'=> $plan->id])}}" class="mx-2 btn btn-primary" style="text-decoration: none">
                                 change
                            </a>
                        </li>
                    </ol>
                @empty
                    <p class="mx-4 my-1"><strong>Aucune subscription</strong></p>
                @endforelse
            </div>
            <div class="col-6 mb-4 mx-auto my-3">
                @foreach($subscriptions as $subscription)
                    <a href="{{ route('subscriptions.make', ['id' => $subscription->id]) }}" style="text-decoration: none">
                        <div class="shadow">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $subscription->name }}</h5>
                                    <p class="card-text">{{ $subscription->desc }}</p>
                                    <p class="card-text">{{ $subscription->subscription_type }}</p>
                                    <p class="card-text"><small class="text-warning">{{ $subscription->montant }}</small></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

@endsection
