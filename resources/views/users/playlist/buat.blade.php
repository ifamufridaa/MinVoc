@extends('users.components.usersTemplates')

@section('content')
    <link rel="stylesheet" href="/user/assets/css/buatPlaylist.css">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 stretch-card">
                    <div class="custom-container">
                        <div class="row">
                            <div class="col-3">
                                <a href="#popup" class="card coba">
                                    <i class="fas fa-music fa-3x"></i>
                                </a>
                            </div>
                            <div class="col-3 text-xxl-end">
                                <div class="bottom-left-text d-flex flex-column gap-1">
                                    <a href="#popup">
                                        <h3 style="font-size: 18px; font-weight: 500">Buat Playlist</h3>
                                    </a>
                                    <div class="img-and-text">
                                        <img class="img-ss rounded-circle" src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                            alt="">
                                        <p class="judulnottebal fw-bold">Henry Klein</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr class="divider"> <!-- Divider -->
                </div>
                <div class="col-md-12 grid-margin stretch-card">
                    <h3 class="card-title judul">Mari temukan lagu untuk playlist anda</h3>
                    <form class="col-6 mb-4 p-0 nav-link search">
                        <input type="text" id="search_song" class="form-control rounded-4" placeholder="Cari musik">
                        <ul id="search-results-song"></ul>
                    </form>
                    <div class="card scroll scrollbar-down thin">
                        <div class="card-body">
                            <div class="row" style="margin-top: -20px">
                                <div class="col-12">
                                    <div class="preview-list">
                                        @php
                                            $index_no = 0;
                                        @endphp
                                        @foreach ($songs as $item)
                                            <div class="preview-item">
                                                <div class="preview-thumbnail">
                                                    <img src="{{ asset('storage/' . $item->image) }}" width="10%">
                                                </div>
                                                <div class="preview-item-content d-sm-flex flex-grow">
                                                    <a href="#lagu-diputar" class="flex-grow text-decoration-none link"
                                                        onclick="putar({{ $item->id }})">
                                                        <h6 class="preview-subject">{{ $item->judul }}</h6>
                                                        <p class="text-muted mb-0">{{ $item->artist->user->name }}</p>
                                                    </a>
                                                </div>
                                                @if ($loop->index == $index_no)
                                                    @php
                                                        $currentSong = $item;
                                                        $currentSongId = $currentSong->id;
                                                        $currentSongLiked = $currentSong->likes > 0;
                                                    @endphp
                                                @endif
                                                <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                    <div class="text-group align-items-center">
                                                        <i id="audio-player-like-icon like" data-id="{{ $item->id }}"
                                                            onclick="toggleLike(this, {{ $item->id }})"
                                                            class="shared-icon-like {{ $item->likes > 0 ? 'fas' : 'far' }} fa-heart pr-2"></i>
                                                        <p style="pointer-events: none;">{{ $item->waktu }}</p>
                                                        <a data-bs-toggle="modal"
                                                            data-bs-target="#staticBackdrop-{{ $item->code }}"
                                                            style="color: #957dad">
                                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px"
                                                                y="0px" width="20" height="20"
                                                                viewBox="0 2 24 24">
                                                                <path fill="#957DAD"
                                                                    d="M 12 2 C 6.4889971 2 2 6.4889971 2 12 C 2 17.511003 6.4889971 22 12 22 C 17.511003 22 22 17.511003 22 12 C 22 6.4889971 17.511003 2 12 2 z M 12 4 C 16.430123 4 20 7.5698774 20 12 C 20 16.430123 16.430123 20 12 20 C 7.5698774 20 4 16.430123 4 12 C 4 7.5698774 7.5698774 4 12 4 z M 11 7 L 11 11 L 7 11 L 7 13 L 11 13 L 11 17 L 13 17 L 13 13 L 17 13 L 17 11 L 13 11 L 13 7 L 11 7 z">
                                                                </path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
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

    <div id="popup">
        <div class="card window">
            <div class="card-body">
                <a href="#" class="close-button mdi mdi-close-circle-outline"></a>
                <h3 class="judul">Buat Playlist</h2>
                    <form class="row" action="{{ route('buat.playlist') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-4">
                            <div class="card cobai">
                                <label for="gambar" id="tampil_gambar">
                                    <i class="fas fa-pen fa-2x"></i>
                                </label>
                                <input type="file" id="gambar" name="images" accept="image/png,image/jpg">
                            </div>
                        </div>
                        <div class="col-md-7 ml-4">
                            <div class="mb-3">
                                <input type="text" class="form-control form-i" name="name" id="nama"
                                    placeholder="Judul Playlist">
                            </div>
                            <div class="mb-3">
                                <textarea id="deskripsi" class="form-control" name="deskripsi" maxlength="500" rows="6" placeholder="Deskripsi"></textarea>
                            </div>
                        </div>
                        <div class="text-md-right">
                            <button class="btn" type="submit">Simpan</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
    </div>
    </div>



    <script>
        
        function myFunction(x) {
            x.classList.toggle("far"); // Menghapus kelas "fa fa-heart"
            x.classList.toggle("fas"); // Menambahkan kelas "fas fa-heart"
            x.classList.toggle("warna-kostum-like"); // Menambahkan kelas warna merah
        }

        const gambar = document.querySelector("#gambar");

        const tampilGambar = document.querySelector("#tampil_gambar");

        gambar.addEventListener("change", function() {
            const reader = new FileReader();

            reader.addEventListener("load", () => {
                tampilGambar.style.backgroundImage = `url(${reader.result})`;

                tampilGambar.innerHTML = "";
            });

            reader.readAsDataURL(this.files[0]);
        });
    </script>
@endsection
