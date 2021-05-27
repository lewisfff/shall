<div class="sidebar minimap">
    @foreach($photos as $photo)
                <div class="image">
                    <a href="#{{ $photo }}" class="side-image">
                        <img src="{{ '/thumbnail/' . $photo }}" class="img-fluid" loading="lazy"
                             alt="{{ $photo }}"
                             width="{{ $meta->$photo->width / 10 }}" height="{{ $meta->$photo->height / 10 }}">
                    </a>
                </div>
    @endforeach
</div>
