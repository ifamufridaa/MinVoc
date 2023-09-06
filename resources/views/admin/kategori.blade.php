@extends('admin.components.adminTemplate')
@section('content')
    <link rel="stylesheet" href="/admin/assets/css/kategori.css">

    <div class="main-panel">
        <style>
            .table td img {
                width: 60px;
                height: 60px;
                margin-right: 10px;
                border-radius: 0;
                object-fit: cover;
            }
        </style>
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="sejajar">
                            <h3 class="judul">Kategori</h3>
                            <div class="text-lg-end mb-3">
                                <button class="btn full-width-btn" type="button" data-bs-toggle="modal"
                                    data-bs-target="#popuptambah">
                                    <i class="fas fa-plus"></i>
                                    Tambah kategori
                                </button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="table-body">
                                    <div class="table-container">
                                        <table class="table">
                                            <thead class="table-header">
                                                <tr class="table-row headerlengkung">
                                                    <th class="table-cell">Gambar</th>
                                                    <th class="table-cell">Nama Kategori</th>
                                                    <th class="table-cell">Tanggal Pembuatan</th>
                                                    <th class="table-cell">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($genres as $item)
                                                    <tr class="table-row">
                                                        <td class="table-cell">
                                                            <div class="cell-content">
                                                                <img src="{{ asset('storage/' . $item->images) }}" alt="Face" class="avatar" width="60">
                                                            </div>
                                                        </td>
                                                        <td class="table-cell">{{ $item->name }}</td>
                                                        <td class="table-cell">{{ $item->created_at->format('d F Y') }}</td>
                                                        <td class="table-cell">
                                                                <button type="button" class="btn btnicon" data-toggle="modal"data-target="#exampleModalCenter{{ $item->id }}">
                                                                    <i class="fas fa-edit " style="color: #5b6b89"></i>   </button>
                                                            <button class="btn btnicon"
                                                                onclick="deleteGenre('{{ $item->code }}')">
                                                                <i class="far fa-times-circle text-danger"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>



                                    <div class="text-center">
                                        <div class="text-center">
                                            <ul class="pagination justify-content-center">
                                                <!-- Item-item pagination akan ditambahkan secara dinamis menggunakan JavaScript -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- partial -->
                    </div>

                    <!-- popup -->
                    <div id="popuptambah">
                        <div class="card window">
                            <div class="card-body">
                                <a href="#" class="close-button far fa-times-circle"></a>
                                <h3 class="judul">Tambah Kategori</h3>
                                <form class="row" action="{{ route('buat.genre') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="namakategori" class="form-label judulnottebal">Nama Kategori</label>
                                            <input type="text" name="name" class="form-control form-i" id="namaproyek"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="upload" class="form-label judulnottebal">Upload Foto</label>
                                            <input type="file" name="images" class="form-control form-i" id="upload"
                                                required>
                                        </div>
                                        <div class="text-md-right">
                                            <button type="submit" class="btn">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- page-body-wrapper ends -->
            </div>
            <!--modal-->
            @foreach ( $genres as $item)

            <div class="modal fade" id="exampleModalCenter{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="card window">
                    <div class="card-body">
                        <a href="" class="close-button far fa-times-circle"></a>
                        <h3 class="judul">Edit Kategori</h3>
                        <form class="row" action="{{ route('edit.genre', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                         
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="namakategori" class="form-label judulnottebal">Nama Kategori</label>
                                    <input type="text" name="name" class="form-control form-i" id="namaproyek" value="{{ $item->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="upload" class="form-label judulnottebal">Upload Foto</label>
                                    <input type="file" name="images" class="form-control form-i" id="namaproyek">
                                    @if(isset($item->images))
                                    <img src="{{ asset('storage/' . $item->images) }}" alt="Foto Lama" width="100">
                                    @endif
                                </div>

                            </div>
                            <div class="text-md-right">
                                <button type="submit" class="btn" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @endforeach


            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                /* ============Dengan Rupiah=========== */
                var harga = document.getElementById('harga');
                harga.addEventListener('keyup', function(e) {
                    harga.value = formatRupiah(this.value, 'Rp. ');
                });

                /* Fungsi */
                function formatRupiah(angka, prefix) {
                    var number_string = angka.replace(/[^,\d]/g, '').toString(),
                        split = number_string.split(','),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }

                    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
                }


                /*================Pagination===================*/

                $(document).ready(function() {
                    var itemsPerPage = 5;

                    $(".table-row").hide();


                    $(".table-row").slice(0, itemsPerPage).show();


                    var numPages = Math.ceil($(".table-row").length / itemsPerPage);


                    for (var i = 1; i <= numPages; i++) {
                        $(".pagination").append("<li class='page-item'><a class='page-link' href='#'>" + i + "</a></li>");
                    }

                    if (numPages <= 1) {
                        $(".pagination").hide();
                    }

                    $(".pagination a").click(function(e) {
                        e.preventDefault();
                        var page = $(this).text();
                        var start = (page - 1) * itemsPerPage;
                        var end = start + itemsPerPage;
                        $(".table-row").hide();
                        $(".table-row").slice(start, end).show();
                        $(".pagination a").removeClass("active");
                        $(this).addClass("active");
                    });

                    $(".pagination .prev").click(function(e) {
                        e.preventDefault();
                        var activePage = $(".pagination .active").text();
                        var prevPage = parseInt(activePage) - 1;
                        if (prevPage >= 1) {
                            $(".pagination a").eq(prevPage - 1).click();
                        }
                    });
                });
            </script>
        @endsection
