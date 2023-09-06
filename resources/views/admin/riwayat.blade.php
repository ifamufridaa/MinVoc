@extends('admin.components.adminTemplate')
@section('content')
    <link rel="stylesheet" href="/admin/assets/css/riwayat.css">
    <!-- partial | ISI -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <h3 class="judul mb-3">Riwayat Persetujuan Unggah Lagu</h3>
                <div class="table-container">
                    <table class="table table-sortable">
                        <thead>
                            <tr class="table-row table-header">
                                <th class="table-cell">Nama<i class="fas fa-sort" data-order="asc"></th>
                                <th class="table-cell">Tanggal<i class="fas fa-sort" data-order="asc"></th>
                                <th class="table-cell">Status<i class="fas fa-sort" data-order="asc"></th>
                                <th class="table-cell">Aksi<i class="fas fa-sort" data-order="asc"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-row baris">
                                <td class="table-cell">
                                    <div class="cell-content">
                                        <img src="../assets/images/faces/face1.jpg" alt="Face" class="avatar">
                                        <div>
                                            <h6>Ada Saja</h6>
                                            <p class="text-muted m-0">tulus</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-cell">03/12/2023</td>
                                <td class="table-cell text-success">Selesai</td>
                                <td class="table-cell">
                                    <button class="btn btnicon">
                                        <i class="far fa-trash-alt text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row baris">
                                <td class="table-cell">
                                    <div class="cell-content">
                                        <img src="../assets/images/faces/face1.jpg" alt="Face" class="avatar">
                                        <div>
                                            <h6>Katakan Saja</h6>
                                            <p class="text-muted m-0">tulus</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-cell">05/12/2023</td>
                                <td class="table-cell text-success">Selesai</td>
                                <td class="table-cell">
                                    <button class="btn btnicon">
                                        <i class="far fa-trash-alt text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row baris">
                                <td class="table-cell">
                                    <div class="cell-content">
                                        <img src="../assets/images/faces/face1.jpg" alt="Face" class="avatar">
                                        <div>
                                            <h6>Sudah Cukup</h6>
                                            <p class="text-muted m-0">tulus</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-cell">10/12/2023</td>
                                <td class="table-cell text-success">Selesai</td>
                                <td class="table-cell">
                                    <button class="btn btnicon">
                                        <i class="far fa-trash-alt text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row baris">
                                <td class="table-cell">
                                    <div class="cell-content">
                                        <img src="../assets/images/faces/face1.jpg" alt="Face" class="avatar">
                                        <div>
                                            <h6>Nemen</h6>
                                            <p class="text-muted m-0">tulus</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-cell">15/12/2023</td>
                                <td class="table-cell text-success">Selesai</td>
                                <td class="table-cell">
                                    <button class="btn btnicon">
                                        <i class="far fa-trash-alt text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row baris">
                                <td class="table-cell">
                                    <div class="cell-content">
                                        <img src="../assets/images/faces/face1.jpg" alt="Face" class="avatar">
                                        <div>
                                            <h6>Kok Iso Yo</h6>
                                            <p class="text-muted m-0">tulus</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-cell">20/12/2023</td>
                                <td class="table-cell text-success">Selesai</td>
                                <td class="table-cell">
                                    <button class="btn btnicon">
                                        <i class="far fa-trash-alt text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row baris">
                                <td class="table-cell">
                                    <div class="cell-content">
                                        <img src="../assets/images/faces/face1.jpg" alt="Face" class="avatar">
                                        <div>
                                            <h6>Ada Saja</h6>
                                            <p class="text-muted m-0">tulus</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-cell">03/12/2023</td>
                                <td class="table-cell text-success">Selesai</td>
                                <td class="table-cell">
                                    <button class="btn btnicon">
                                        <i class="far fa-trash-alt text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row baris">
                                <td class="table-cell">
                                    <div class="cell-content">
                                        <img src="../assets/images/faces/face1.jpg" alt="Face" class="avatar">
                                        <div>
                                            <h6>Katakan Saja</h6>
                                            <p class="text-muted m-0">tulus</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-cell">05/12/2023</td>
                                <td class="table-cell text-success">Selesai</td>
                                <td class="table-cell">
                                    <button class="btn btnicon">
                                        <i class="far fa-trash-alt text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row baris">
                                <td class="table-cell">
                                    <div class="cell-content">
                                        <img src="../assets/images/faces/face1.jpg" alt="Face" class="avatar">
                                        <div>
                                            <h6>Sudah Cukup</h6>
                                            <p class="text-muted m-0">tulus</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-cell">10/12/2023</td>
                                <td class="table-cell text-success">Selesai</td>
                                <td class="table-cell">
                                    <button class="btn btnicon">
                                        <i class="far fa-trash-alt text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row baris">
                                <td class="table-cell">
                                    <div class="cell-content">
                                        <img src="../assets/images/faces/face1.jpg" alt="Face" class="avatar">
                                        <div>
                                            <h6>Nemen</h6>
                                            <p class="text-muted m-0">tulus</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-cell">15/12/2023</td>
                                <td class="table-cell text-success">Selesai</td>
                                <td class="table-cell">
                                    <button class="btn btnicon">
                                        <i class="far fa-trash-alt text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row baris">
                                <td class="table-cell">
                                    <div class="cell-content">
                                        <img src="../assets/images/faces/face1.jpg" alt="Face" class="avatar">
                                        <div>
                                            <h6>Kok Iso Yo</h6>
                                            <p class="text-muted m-0">tulus</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-cell">20/12/2023</td>
                                <td class="table-cell text-success">Selesai</td>
                                <td class="table-cell">
                                    <button class="btn btnicon">
                                        <i class="far fa-trash-alt text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <div class="text-center">
                    <div class="text-center">
                        <ul class="pagination justify-content-center">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>


    <script src="/user/assets/js/tablesort.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        /*===================================*/

        $(document).ready(function() {
            var itemsPerPage = 4;
            var currentPage = 1;

            function setURLParameter(page) {
                var newURL = window.location.href.split('?')[0] + '?page=' + page;
                window.history.replaceState({}, document.title, newURL);
            }

            function getURLParameter() {
                var urlParams = new URLSearchParams(window.location.search);
                return parseInt(urlParams.get('page')) || 1;
            }

            currentPage = getURLParameter();

            function showTableRows() {
                var start = (currentPage - 1) * itemsPerPage;
                var end = start + itemsPerPage;
                $(".baris").hide();
                $(".baris").slice(start, end).show();
            }

            function updatePagination() {
                $(".pagination").empty();
                var numPages = Math.ceil($(".baris").length / itemsPerPage);

                for (var i = 1; i <= numPages; i++) {
                    var activeClass = i === currentPage ? "active" : "";
                    var buttonText = i.toString();
                    var buttonClass = "page-link";
                    if (i === currentPage) {
                        buttonClass += " active";
                    }

                    var button = $("<button>")
                        .addClass("page-item " + activeClass)
                        .addClass(buttonClass)
                        .text(buttonText);

                    button.click(function() {
                        var page = parseInt($(this).text());
                        currentPage = page;
                        setURLParameter(currentPage);
                        showTableRows();
                        updatePagination();
                    });

                    $(".pagination").append($("<li>").append(button));
                }

                if (numPages <= 1) {
                    $(".pagination").hide();
                }
            }

            showTableRows();
            updatePagination();

            setURLParameter(currentPage);
        });
    </script>
@endsection
