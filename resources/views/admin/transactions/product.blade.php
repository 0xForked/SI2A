@foreach ($products as $product)
<div class="col-12 col-sm-6 col-md-6 col-lg-4">
    <article class="article article-style-b">
        <div class="article-header">
            <div
                class="article-image"
                data-background="https://demo.getstisla.com/assets/img/news/img13.jpg"></div>
            <div class="article-badge">
                <div class="article-badge-item bg-danger" data-toggle="tooltip" data-placement="top" title="Stok Tersedia">
                    <i class="fas fa-layer-group"></i>
                    {{$product->stock}}
                </div>
            </div>
        </div>
        <div class="article-details">
            <div class="article-title">
                <b>{{$product->name}}</b>
            </div>
            <div class="article-cta">
                <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Tambah ke Cart">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
    </article>
</div>
@endforeach