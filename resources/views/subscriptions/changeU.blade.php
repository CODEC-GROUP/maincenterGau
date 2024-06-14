@extends('welcome')

@section('body')
    <main class="container-fluid mt-3">
        <section class="row">
            <div class="col-10">
                <form action="{{route('subscriptions.changeU',['id'=>$plans->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="subscription_id">
                            @foreach($subscriptions as $subscription)
                                @if($plans->subscription_id == $subscription->id)
                                    <option value="{{$subscription->id}}">
                                        {{$subscription->name}}
                                    </option>
                                @endif
                            @endforeach
                            @foreach($subscriptions as $subscription)
                                @if($plans->subscription_id == $subscription->id)
                                @else
                                    <option value="{{$subscription->id}}">{{$subscription->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('subscription_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="w-100 btn btn-primary">Modifier la subscription</button>
                </form>
            </div>
        </section>
    </main>
@endsection
