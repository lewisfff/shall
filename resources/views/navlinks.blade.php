@foreach($directories as $directory)
    <ul>
        <li class="nav-item">
            <a class="nav-link {{ ($page == $directory ? 'active' : '') }}" href="/{{ $directory }}">
                {!!  basename($directory) !!}
            </a>
        </li>

        @if (!empty(Storage::disk('photos')->directories($directory)))
            @include('navlinks', ['directories' => Storage::disk('photos')->directories($directory)])
        @endif
    </ul>
@endforeach
