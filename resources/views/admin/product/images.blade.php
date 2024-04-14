<div class="card">
    <div class="card-body">
        <div class="gallery gallery-md">
            @foreach ($productImages as $productImage)
                <div class="gallery-item" style="background-image: url({!! asset('uploads/' . $productImage->name) !!})">
                    <button id="{{ $productImage->id }}" class="fas fa-times-circle delete-image"
                        style="color: red; font-size:25px; background-color: transparent;  border: none;cursor:pointer;"></button>
                </div>
            @endforeach
        </div>
    </div>
</div>
