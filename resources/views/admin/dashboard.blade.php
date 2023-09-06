@extends('admin.components.adminTemplate')
@section('content')
    <link rel="stylesheet" href="/admin/assets/css/dashboard.css">
    <!-- partial | ISI -->
    <div class="main-panel">
        <style>
            .avatar {
                width: auto;
                /* Menghapus lebar tetap */
                height: 40px;
                /* Menentukan tinggi gambar */
                object-fit: cover;
                /* Memastikan gambar diisi sepenuhnya dan tidak melar */
                margin-right: 10px;
                border-radius: 0;
            }
        </style>
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-2">
                            <div class="card coba">
                                <h3 class="angka m-0">{{ $totalPengguna }} <span class="fas fa-user fa-sm ikon"></span></h3>
                                <h4 class="judul mb-3">Pengguna</h4>
                                <p class="teks">Sejak 2023</p>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card coba">
                                <h3 class="angka m-0">{{ $totalLagu }}<span
                                        class="fas fa-microphone-alt fa-sm ikon"></span></h3>
                                <h4 class="judul mb-3">Lagu</h4>
                                <p class="teks">Sejak 2023</p>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card coba">
                                <h3 class="angka m-0">{{ $totalArtist }} <span class="fas fa-music fa-sm ikon"></span></h3>
                                <h4 class="judul mb-3">Artis</h4>
                                <p class="teks">Sejak 2023</p>
                            </div>
                        </div>
                        <div class="col-6 row no-gutters">
                            <div class="card coba">
                                <img src="/assets/images/logo.svg" width="80%" height="100%" alt="logo"
                                    class="ml-5 md-3" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="card coba">
                        <canvas id="myChart" width="800" height="300"></canvas>
                    </div>
                </div>


                <div class="col-md-12">
                    <h3 class="judul">Riwayat Persetujuan </h3>
                    <div class="card mb-3">
                        <div class="table-body">
                            <div class="table-container">
                                <table class="table">
                                    <thead class="table-header">
                                        <tr class="table-row headerlengkung">
                                            <th class="table-cell">Judul Lagu</th>
                                            <th class="table-cell">Genre</th>
                                            <th class="table-cell">Tanggal Pengajuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($songs as $item)
                                            @if ($item->is_approved)
                                                <tr class="table-row">
                                                    <td class="table-cell">
                                                        <div class="cell-content">
                                                            <img src="{{ asset('storage/' . $item->image) }}" alt="Face"
                                                                class="avatar">
                                                            <div>
                                                                <h6>{{ $item->judul }}</h6>
                                                                <p class="text-muted m-0">{{ $item->artist->user->name }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="table-cell">{{ $item->genre->name }}</td>
                                                    <td class="table-cell">{{ $item->created_at->format('d F Y') }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <script>
        function myFunction(x) {
            x.classList.toggle("far"); // Menghapus kelas "fa fa-heart"
            x.classList.toggle("fas"); // Menambahkan kelas "fas fa-heart"
            x.classList.toggle("warna-kostum-like"); // Menambahkan kelas warna merah
        }
    </script>
    <script>
        // Kode JavaScript untuk membuat grafik
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                    'Oktober', 'November', 'Desember'
                ],
                datasets: [{
                    label: 'Pendapatan',
                    data: [1, 3.5, 2.5, 0.5, 4.5, 1, 2, 5, 4, 2.5, 3, 1.5],
                    backgroundColor: [
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(153, 102, 255, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
