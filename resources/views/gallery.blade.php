@extends('app')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">{{ $page ?? '' }}</h1>
    </div>

    @foreach($photos as $photo)

        <div class="row">
            <div class="col">
                <div class="imageTarget" id="{{ $photo }}"></div>
                <div class="image">
                    <a target="_blank" href="{{ '/source/' . $photo }}">
                        <img src="{{ '/storage/' . $photo }}" class="img-fluid lazy"
                             alt="{{ $photo }}"
                             style="width: {{ $meta->$photo->width }}px; height: {{ $meta->$photo->height }}px">
                    </a>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@section('nav')
    @include('navlinks', $directories)
@endsection
