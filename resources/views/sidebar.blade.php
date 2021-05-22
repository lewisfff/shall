<div class="sidebar minimap">
    @foreach($photos as $photo)
                <div class="image">
                    <a href="#{{ $photo }}">
                        <img src="/blank.gif" data-src="{{ '/storage/thumbnail/' . $photo }}" class="img-fluid lazy"
                             alt="{{ $photo }}"
                             width="160" height="auto">
                    </a>
                </div>
    @endforeach
</div>
