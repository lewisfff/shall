@extends('app')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">{{ $page ?? '' }}</h1>
    </div>

    @foreach($photos as $photo)
        <div class="row">
            <div class="col">
                <div class="image">
                    <a target="_blank" href="{{ '/source/' . $photo }}">
                        <img src="/blank.gif" data-src="{{ '/storage/' . $photo }}" class="img-fluid lazy"
                             alt="{{ $photo }}"
                             width="1600" height="auto">
                    </a>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@section('nav')
    @include('navlinks', $directories)
@endsection
