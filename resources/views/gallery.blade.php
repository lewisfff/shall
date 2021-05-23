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
                        <img class="img-fluid lazyload lazy"
                             data-src="{{ '/storage/' . $photo }}"
                             loading="lazy"
                             alt="{{ $photo }}"
                             width="{{ $meta->$photo->width }}" height="{{ $meta->$photo->height }}"
                             style="background-image: url('{{ '/thumbnail/' . $photo }}')">
                    </a>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@section('nav')
    @include('navlinks', $directories)
@endsection
