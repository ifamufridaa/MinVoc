@extends('artis.components.artisTemplate')

@section('content')
    <link rel="stylesheet" href="/user/assets/css/dashboard.css">

    @include('partials.tambahkeplaylist')


    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <h3 class="card-title mt-2 judul" style="font-size: 20px; font-weight: 600">Kategori</h3>
                    <div class="cards">
                        @foreach ($genres as $item)
                            <a href="/artis-verified/kategori/{{ $item->code }}" class="card card-scroll">
                                <img src="{{ asset('storage/' . $item->images) }}" class="img-fluid rounded-4 this">
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card border-0 bg-dark coba">
                        <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($billboards as $item)
                                    <div class="carousel-item active" data-bs-interval="2000">
                                        <a href="{{ route('detail.billboard', $item->code) }}" class="image-container">
                                            <img src="{{ asset('storage/' . $item->image_background) }}" class="d-block try"
                                                alt="...">
                                            <div class="bottom-left">
                                                <h3 class="text-light">{{ $item->name }}</h3>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <h3 class="card-title mt-2 judul" style="font-size: 20px; font-weight: 600">Lagu Yang Disarankan</h3>
                    <div class="card datakanan scrollbar-down thin">
                        <div class="card-body">
                            <div class="row" style="margin-top: -20px">
                                <div class="col-12">
                                    <div class="preview-list">
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($songs as $item)
                                            @if ($item->is_approved)
                                                <div class="preview-item">
                                                    <div class="preview-thumbnail">
                                                        <img src="{{ asset('storage/' . $item->image) }}" width="10%">
                                                    </div>
                                                    <div class="preview-item-content d-sm-flex flex-grow">
                                                        <a href="#lagu-diputar" class="flex-grow text-decoration-none link"
                                                            onclick="putar({{ $i++ }})">
                                                            <h6 class="preview-subject">{{ $item->judul }}</h6>
                                                            <p class="text-muted mb-0">{{ $item->artist->user->name }}</p>
                                                        </a>
                                                    </div>
                                                    <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                        <div class="text-group align-items-center">
                                                            <i onclick="toggleLike({{ $item->id }},this)"
                                                                class="far fa-heart pr-2"></i>
                                                            <p style="pointer-events: none;">{{ $item->waktu }}</p>
                                                            <p style="pointer-events: none;" style="color: #957dad"><svg
                                                                    width="22" height="6" viewBox="0 0 22 6"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M2.872 5.224C2.21067 5.224 1.656 5 1.208 4.552C0.76 4.104 0.536 3.54933 0.536 2.888C0.536 2.22667 0.76 1.672 1.208 1.224C1.656 0.776 2.21067 0.552 2.872 0.552C3.512 0.552 4.056 0.776 4.504 1.224C4.952 1.672 5.176 2.22667 5.176 2.888C5.176 3.54933 4.952 4.104 4.504 4.552C4.056 5 3.512 5.224 2.872 5.224ZM10.9107 5.224C10.2494 5.224 9.69475 5 9.24675 4.552C8.79875 4.104 8.57475 3.54933 8.57475 2.888C8.57475 2.22667 8.79875 1.672 9.24675 1.224C9.69475 0.776 10.2494 0.552 10.9107 0.552C11.5507 0.552 12.0947 0.776 12.5427 1.224C12.9907 1.672 13.2147 2.22667 13.2147 2.888C13.2147 3.54933 12.9907 4.104 12.5427 4.552C12.0947 5 11.5507 5.224 10.9107 5.224ZM18.9495 5.224C18.2882 5.224 17.7335 5 17.2855 4.552C16.8375 4.104 16.6135 3.54933 16.6135 2.888C16.6135 2.22667 16.8375 1.672 17.2855 1.224C17.7335 0.776 18.2882 0.552 18.9495 0.552C19.5895 0.552 20.1335 0.776 20.5815 1.224C21.0295 1.672 21.2535 2.22667 21.2535 2.888C21.2535 3.54933 21.0295 4.104 20.5815 4.552C20.1335 5 19.5895 5.224 18.9495 5.224Z"
                                                                        fill="#957DAD" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 grid-margin stretch-card">
                    <h3 class="card-title mb-4 judul" style="font-size: 20px; font-weight: 700">Artis yang disukai</h3>
                    <div class="card datakiri scrollbar-down square thin">
                        <div class="card-body">
                            <div class="row" style="margin-top: -20px">
                                <div class="col-12">
                                    <div class="preview-list">
                                        @foreach ($artist as $item)
                                            @if ($item)
                                                <div class="preview-item">
                                                    <div class="preview-thumbnail">
                                                        <img src="/user/assets/images/faces/face1.jpg" width="10%">
                                                    </div>
                                                    <div class="preview-item-content d-sm-flex flex-grow">
                                                        <div class="flex-grow">
                                                            <h6 class="preview-subject">{{ $item->user->name }}</h6>
                                                            <p class="text-muted mb-0">{{ $item->didengar }} didengar</p>
                                                        </div>
                                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                            <i onclick="myFunction(this)" class="far fa-heart pr-2"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
