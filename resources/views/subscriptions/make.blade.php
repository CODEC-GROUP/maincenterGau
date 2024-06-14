@extends('welcome')

@section('body')
    <main class="container-fluid mt-3">
        <section class="row">
            <div class="col-10">
                <form action="{{route('subscriptions.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="subscription_id">
                                        <option value="{{$subscriptions->id}}">
                                            {{$subscriptions->name}}
                                        </option>
                        </select>
                        @error('subscription_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="w-100 btn btn-primary">subscrire</button>
                </form>
            </div>
        </section>
    </main>
@endsection

