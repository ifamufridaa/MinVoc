@extends('artisVerified.components.artisVerifiedTemplate')

@section('content')
    <div class="main-panel">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
        </script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <style>
            button {
                border: none;
                background: none;
            }

            .note-editor.note-frame .note-editing-area {
                overflow: hidden;
                background-color: #ffffff;
            }

            .dropdown-toggle::after {
                content: none;
            }

            .input-with-icon {
                display: flex;
                align-items: center;
            }

            .form-control {
                flex: 1;
            }

            .send-button {
                background-color: #957dad;
                /* Warna latar belakang tombol */
                color: #fff;
                /* Warna teks tombol */
                border: none;
                padding: 5px 10px;
                border-radius: 4px;
                cursor: pointer;
            }

            .send-button:hover {
                background-color: #634582;
                /* Warna latar belakang tombol saat dihover */
            }

            .full-width-button {
                width: 100%;
            }

            .slider {
                margin: 5px 0;
                width: 450px;
            }

            .slider:focus {
                outline: none;
            }

            .slider::-webkit-slider-runnable-track {
                width: 450px;
                cursor: pointer;
                animate: 0.2s;
                border-radius: 25px;
            }

            .slider::-webkit-slider-thumb {
                height: 20px;
                width: 20px;
                border-radius: 50%;
                background: #fff;
                box-shadow: 0 0 4px 0 rgba(0, 0, 0, 1);
                cursor: pointer;
            }

            .range-wrap {
                width: 450px;
                position: relative;
            }

            .range-value {
            }

            .range-value span {
                width: 30px;
                height: 24px;
                line-height: 24px;
                text-align: center;
                color: #957DAD;
                font-size: 12px;
                display: block;
                position: absolute;
                left: 50%;
                transform: translate(-50%, 0);
                border-radius: 6px;
            }

            .range-value span:before {
                position: absolute;
                width: 0;
                height: 0;
                border-left: 5px solid transparent;
                border-right: 5px solid transparent;
                top: 100%;
                left: 50%;
                margin-left: -5px;
                margin-top: -1px;
            }

            .output {
                margin-bottom: -100px;
                width: 100%;
                font-size: 2em;
                color: #957DAD;
            }
        </style>
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-7">
                    <div class="card kiri scrollbar-dusty-grass square thin rounded-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="preview-list">
                                        <form action="{{ route('create.project.artisVerified') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="code" value="{{ $project->code }}">
                                            <div class="preview-item">
                                                <div class="preview-item-content d-sm-flex flex-grow">
                                                    <h3 class="fw-semibold" style="color: #957dad; margin-top: -30px;">
                                                        Project
                                                        {{ $project->name }}</h3>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" name="judul"
                                                    class="form-control form-i input-judul pl-3" id="namaproyek"
                                                    placeholder="Judul Lagu" style="background-color: #ffffff" required>
                                            </div>
                                            <textarea name="lirik" id="summernote" style="background-color: #ffffff; border: 1px solid #6d6d6d"></textarea>
                                            <script>
                                                $('#summernote').summernote({
                                                    placeholder: 'Teks',
                                                    tabsize: 2,
                                                    height: 250,
                                                    toolbar: [
                                                        ['style', ['style']],
                                                        ['font', ['bold', 'underline', 'clear']],
                                                        ['color', ['color']],
                                                        ['para', ['paragraph']],
                                                        ['view', ['codeview']]
                                                    ]
                                                });
                                            </script>
                                            <div class="mt-3">
                                                <button class="btn pl-3 kirim rounded-3 full-width-button" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#kirimkolaborasi">
                                                    kirim
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card kanan scrollbar-dusty-grass square thin rounded-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="preview-list">
                                        <div class="preview-item">
                                            <div class="preview-item-content d-sm-flex flex-grow">
                                                <h3 class="fw-semibold mb-3" style="color: #957dad; margin-top: -30px;">Chat
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="chat" style="margin-top: -20px; position: relative">
                                            <form action="{{ route('message.project.artisVerified') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id_project" value="{{ $project->id }}">
                                                <div class="card ">
                                                    <div style="height: 415px">
                                                        <div class="card-body"
                                                            style="overflow-y: scroll; height: 70vh; background-color: white; border-radius: 10px; border: 1px solid rgba(0,0,0,.2);">
                                                            <div style="display: flex; flex-direction: column;">
                                                                {{-- <span
                                                                style="font-size: 12px; margin-bottom: 3px; color: rgb(171, 171, 171)">ghhhh</span>
                                                            <span class="mb-2"
                                                                style="font-size: 14px; color: rgb(52, 52, 52); background-color: whitesmoke; max-width: 50%; border-radius: 15px; text-align: left; padding: 3px 10px">ewfawe
                                                            </span> --}}
                                                                @foreach ($datas as $key => $item)
                                                                    @if ($key == 0 || $item->messages->name != $datas[$key - 1]->messages->name)
                                                                        <span
                                                                            style="font-size: 12px; margin-bottom: 3px; color: rgb(171, 171, 171)">ghhhh</span>
                                                                    @endif
                                                                    <span class="mb-2"
                                                                        style="font-size: 14px; color: rgb(52, 52, 52); background-color: whitesmoke; max-width: 50%; border-radius: 15px; text-align: left; padding: 3px 10px">{{ $item->message }}</span>
                                                                @endforeach
                                                            </div>
                                                            <div class="input-with-icon"
                                                                style="position: absolute; bottom: 0; left: 0; right: 10px; padding: 10px;">
                                                                <input type="text" class="form-control rounded-4"
                                                                    placeholder="ketik di sini untuk admin" name="message">
                                                                <button type="submit" class="send-button ml-2 mr-1">
                                                                    <i class="fas fa-paper-plane"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="kirimkolaborasi" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0" style="background-color: white">
                        <div class="modal-header border-0">
                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: #957DAD">Pembayaran</h1>
                            <button type="button" class="btn-unstyled" data-bs-dismiss="modal" aria-label="Close">
                                <i class="mdi mdi-close-circle-outline btn-icon" style="color: #957DAD"></i>
                            </button>
                        </div>
                        <div class="modal-body border-0">
                            <div class="col-md-12" style="font-size: 13px">
                                <h5 class="judulnottebal mb-4">Persentase Pembayaran</h5>
                                <div class="mb-3">
                                    <div class="range-wrap">
                                        <div class="range-value" id="rangeV">0%</div>
                                        <input class="slider mb-4" id="range" type="range" min="0" max="100" value="0" step="1">
                                        <output for="range" class="output">Rp. 0</output>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn rounded-3 full-width-button">
                                <a href="" class="btn-link"
                                    style="color: inherit; text-decoration: none;">Bayar</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const range = document.getElementById('range');
        const rangeV = document.getElementById('rangeV');
        const output = document.querySelector('.output');
    
        const setValue = () => {
            const persentase = Number(range.value);
            const uang = (persentase / 100) * 2000000; // 2 juta
            rangeV.innerHTML = `${persentase}%`;
    
            // Konversi nilai uang ke format Rupiah (Rp)
            const harga = formatRupiah(uang);
            output.textContent = `Rp. ${harga}`;
        };
    
        // Fungsi untuk mengonversi nilai menjadi format Rupiah (Rp)
        const formatRupiah = (angka) => {
            let reverse = angka.toString().split('').reverse().join('');
            let ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return ribuan;
        };
    
        document.addEventListener("DOMContentLoaded", () => {
            setValue();
        });
    
        range.addEventListener('input', () => {
            setValue();
        });
    
        // Agar rangeV mengikuti pergerakan thumb
        range.addEventListener('mousemove', () => {
            const newValue = Number(range.value);
            const newPosition = 10 - (newValue * 0.2);
            rangeV.style.left = `calc(${newValue}% + (${newPosition}px))`;
        });
    </script>    
    </div>
@endsection
