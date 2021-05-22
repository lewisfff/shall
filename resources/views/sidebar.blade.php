<div class="sidebar minimap">
    @foreach($photos as $photo)
                <div class="image">
                    <a href="#{{ $photo }}">
                        <img src="{{ '/storage/thumbnail/' . $photo }}" class="img-fluid"
                             alt="{{ $photo }}"
                             width="160" height="auto">
                    </a>
                </div>
    @endforeach
</div>
