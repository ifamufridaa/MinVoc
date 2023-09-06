@extends('admin.components.adminTemplate')

@foreach ($artist as $item)
    <div class="modal fade" id="staticBackdrop-{{ $item->code }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('tambah.verified', $item->code) }}" method="post">
                @csrf
                <div class="modal-content" style="background-color: whitesmoke">
                    <div class="card-body">
                        <a href="" class="close-button far fa-times-circle"></a>
                        <h3 class="judul">Detail Pengajuan Verifikasi Akun</h3>
                        <div class="row mt-4">
                            <div class="col-md-12 mb-4">
                                <h5 class="judul mb-3">Nama :</h5>
                                <td class="table-cell">
                                    <div class="cell-content">
                                        <img src="{{ asset('storage/' . $item->user->avatar) }}" alt="Face"
                                            class="avatar">
                                        <div>
                                            <p class="teksbiasa">{{ $item->user->name }}</p>
                                        </div>
                                    </div>
                                </td>
                            </div>
                            <div class="col-md-12 mb-4">
                                <h5 class="judul mb-3">Tanggal Pengajuan :</h5>
                                <p class="teksbiasa">{{ $item->pengajuan_verified_at }}</p>
                            </div>
                            <div class="text-md-right">
                                <button type="submit" class="btn">Setujui</button>
                            </div>


                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endforeach


@section('content')
<!-- Modal -->
<<<<<<< HEAD

  <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
=======
@foreach ($artist as $item)
<div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
>>>>>>> b082318d1854a051dc6c80c899aa69a0e8d6f612
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal bg-white">
                <h5 class="modal-title bg-white" id="exampleModalLabel">Alasan Ditolak</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-white">
                {{-- @dd($item) --}}
                <form id="hapus" action="{{ route('hapus.verified', $item->code) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <a href="#" class="close-button far fa-times-circle"></a>
                        <h3 class="judul">Alasan Menolak Persetujuan</h3>
                        <textarea class="form-control mt-3 " id="alasan" name="alasan" rows="10" placeholder="Tulis alasan anda" required></textarea>
                    </div>
                    <div class="text-md-right">
                    <button type="submit" class="btn">Kirim</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

    <link rel="stylesheet" href="/admin/assets/css/verifikasi.css">
    <!-- partial | ISI -->
    <div class="main-panel">
        <style>
            .table-container {
                margin-bottom: 20px;
            }

            .table-sortable th {
                cursor: pointer;
                border-radius: 10px;
            }

            .table-sortable .th-sort-asc::after {
                content: "\25b4";
            }

            .table-sortable .th-sort-desc::after {
                content: "\25be";
            }

            .table-sortable .th-sort-asc::after,
            .table-sortable .th-sort-desc::after {
                margin-left: 10px;
            }

            /*---- style untuk table ----*/
            .table-body {
                padding: 20px;
            }


            .table-container {
                max-width: 100%;
                overflow-x: auto;
            }

            .table {
                width: 100%;
                border-spacing: 0;
            }

            .header {
                margin-bottom: 10px;
                background-color: #957DAD;
                overflow: hidden;
            }

            .table-cell {

                flex: 1;

                padding-left: 10%;

                text-align: left;

                padding: 10px;

            }

            .table-header {
                padding-top: 10px;
                padding-bottom: 10px;
                color: white;
            }

            .avatar {
                width: 40px;
                margin-right: 10px;
            }

            .table td img {
                border-radius: 0;
            }

            .cell-content {
                display: flex;
                align-items: center;
            }

            .table-cell h6,
            .table-cell p {
                margin: 0;
                padding: 5px 0;
            }

            .table-container {
                margin-bottom: 20px;
            }

            /*---- style untuk header dengan border lengkung ----*/
            .headerlengkung th:first-child {
                border-top-left-radius: 10px;
                border-bottom-left-radius: 10px;
            }

            .headerlengkung th:last-child {
                border-top-right-radius: 10px;
                border-bottom-right-radius: 10px;
            }

            /*---- style untuk jangka ----*/
            .card .card-body {
                padding: 5px 20px;
            }
        </style>
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="judul">Daftar Pengajuan Verifikasi Akun</h3>
                    <div class="card mb-3">
                        <div class="table-body">
                            <div class="table-container">
                                <table class="table">
                                    <thead class="table-header">
                                        <tr class="table-row headerlengkung">
                                            <th class="table-cell">Nama Pengguna</th>
                                            <th class="table-cell">Tanggal Pengajuan</th>
                                            <th class="table-cell">Status</th>
                                            <th class="table-cell">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($artist as $item)
                                            @if ($item->pengajuan_verified_at)
                                                <tr class="table-row ">
                                                    <td class="table-cell">
                                                        <div class="cell-content mt-1">
                                                            <img src="{{ asset('storage/' . $item->user->avatar) }}"
                                                                alt="Face" class="avatar mt-1">
                                                            <div>
                                                                <p>{{ $item->user->name }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
<<<<<<< HEAD
                                                    <td class="table-cell mt-1">{{ $item->pengajuan_verified_at}}</td>
=======
                                                    <td class="table-cell mt-1">{{ $item->pengajuan_verified_at }}</td>
>>>>>>> b082318d1854a051dc6c80c899aa69a0e8d6f612
                                                    <td class="table-cell text-warning mt-1">
                                                        {{ $item->verification_status }}
                                                    </td>
                                                    <td class="table-cell">
                                                        <button type="button" class="btn btnicon mt-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#staticBackdrop-{{ $item->code }}">
                                                            <i class="far fa-eye text-info"></i>
                                                        </button>
                                                        <button class="btn btnicon mt-1" data-bs-toggle="modal" data-bs-target="#modal1">
                                                        <i class="far fa-times-circle text-danger"></i>
                                                    </button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        /*===================================*/

        $(document).ready(function() {
            var itemsPerPage = 5;

            // Menyembunyikan semua baris tabel
            $(".table-row").hide();


            // Menampilkan 'itemsPerPage' baris pertama
            $(".table-row").slice(0, itemsPerPage).show();


            // Menghitung jumlah halaman
            var numPages = Math.ceil($(".table-row").length / itemsPerPage);


            // Menambahkan item-item paginatio
            for (var i = 1; i <= numPages; i++) {
                $(".pagination").append("<li class='page-item'><a class='page-link' href='#'>" + i + "</a></li>");
            }

            // Menyembunyikan atau menampilkan pagination berdasarkan jumlah halaman
            if (numPages <= 1) {
                $(".pagination").hide();
            }

            // Mengatur pengklikan pagination
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

            // Menampilkan halaman sebelumnya saat tombol '<<' diklik
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
