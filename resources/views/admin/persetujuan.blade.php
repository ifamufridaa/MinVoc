@extends('admin.components.adminTemplate')
@section('content')
    <link rel="stylesheet" href="/admin/assets/css/persetujuan.css">
    <!-- partial | ISI -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <h3 class="judul mb-4">Persetujuan Unggah Lagu</h3>
                <div class="table-container">
                    <table class="table table-sortable">
                        <thead class="table-header">
                            <tr class="table-row">
                                <th class="table-cell">Judul Lagu</th>
                                <th class="table-cell">Tanggal Pengajuan</th>
                                <th class="table-cell">Status</th>
                                <th class="table-cell">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($persetujuan as $item)
                                @if (!$item->is_approved)
                                    <tr class="table-row">
                                        <td class="table-cell">
                                            <div class="cell-content">
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="Face"
                                                    class="avatar">
                                                <div>
                                                    <h6>{{ $item->judul }}</h6>
                                                    <p class="text-muted m-0">{{ $item->artist->user->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="table-cell">{{ $item->created_at->format('d F Y') }}</td>
                                        <td class="table-cell text-warning">Pending</td>
                                        <td class="table-cell">
                                            <button type="button" class="btn btnicon" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop-{{ $item->code }}">
                                                <i class="far fa-eye text-info"></i>
                                            </button>
                                            <button class="btn btnicon" onclick="deleteSong('{{ $item->code }}')">
                                                <i class="far fa-times-circle text-danger"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
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
        <!-- partial -->
    </div>

    <!-- popup -->
    @foreach ($persetujuan as $item)
        <div class="modal fade" id="staticBackdrop-{{ $item->code }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('setuju.upload.music', $item->code) }}" method="get">
                    @csrf
                    <div class="modal-content" style="background-color: whitesmoke">
                        <div class="card-body">
                            <h3 class="judul">Persetujuan Unggah Lagu</h3>
                            <a href="" class="close-button far fa-times-circle"></a>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="judul">Tanggal Pengajuan</h5>
                                    <p class="teksbiasa">{{ $item->created_at->toDateString() }}</p>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <h5 class="judul">Judul Lagu</h5>
                                    <div class="cell-content">
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="Face" class="avatar" style="width: 40px">
                                        <div>
                                            <h6>{{ $item->judul }}</h6>
                                            <p class="text-muted m-0">{{ $item->artist->user->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-md-right">
                                    <a href="#" class="btn" type="submit">Putar Lagu</a>
                                    <button class="btn" type="submit">Setujui</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    @endforeach
    </div>
    </div>


    <script src="/user/assets/js/tablesort.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        $(document).ready(function() {

            $('.view-button').click(function() {
                // Dapatkan ID data dari tombol "Lihat" yang ditekan
                var itemId = $(this).data('id');

                // Dapatkan data yang sesuai dari tabel berdasarkan ID
                var itemData = <?php echo json_encode($persetujuan->toArray()); ?>.filter(function(item) {
                    return item.id === itemId;
                })[0];

                // Setel data ke dalam elemen-elemen di dalam pop-up
                $('#popup h3.judul').text('Persetujuan Unggah Lagu');
                $('#popup .teksbiasa').text(itemData.created_at);
                $('#popup h6').text(itemData.judul);
                $('#popup p.text-muted').text(itemData.artist.user.name);

                // Tampilkan pop-up
                $('#popup').show();
            });

            // Tambahkan fungsi untuk menutup pop-up saat tombol "Tutup" ditekan
            $('#popup .close-button').click(function() {
                $('#popup').hide();
            });
        });

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
