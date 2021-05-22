@foreach($directories as $directory)
    @if (basename($directory) !== 'thumbnail')
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
    @endif
@endforeach
