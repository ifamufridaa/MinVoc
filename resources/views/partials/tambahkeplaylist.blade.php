<style>
    #tambahkeplaylist {
        width: 100%;
        height: 100%;
        position: fixed;
        background: rgba(0, 0, 0, 0.7);
        top: 0;
        left: 0;
        z-index: 9999;
        visibility: hidden;
    }

    #tambahkeplaylist .card-body {
        padding: 10px 7% 10px 7%;
    }

    /* Memunculkan Jendela Pop Up Detail*/
    #tambahkeplaylist:target {
        visibility: visible;
    }

    .windowi {
        background-color: #ffffff;
        width: 300px;
        border-radius: 10px;
        position: relative;
        margin: 15% auto;
        padding: 10px;
    }

    .close-button {
        display: block;
        color: #957dad;
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .judul {
        font-size: 20px;
    }
</style>
@foreach ($songs as $item)
    <div id="staticBackdrop-{{ $item->code }}" class="modal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="card windowi">
            <div class="card-body">
                <h3 class="judul p-0 mb-4">Tambah Ke Playlist</h3>
                <a href="" class="close-button far fa-times-circle"></a>
                <form class="row" action="{{ route('tambah.playlist', $item->code) }}" method="POST">
                    @csrf
                    <div class="col-m`d-12">
                        <div class="mb-4">
                            <label for="namaartis" class="form-label judulnottebal">Nama Playlist</label>
                            <select name="playlist_id" class="form-select" id="namaartis">
                                <option value="" style="display: none;" selected disabled></option>
                                @foreach ($playlists as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-md-right">
                        <button class="btn" type="submit" onclick="return validateForm();">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<script>
    function validateForm() {
        var selectedOption = document.getElementById("namaartis").value;
        if (selectedOption === "") {
            alert("Pilih sebuah playlist terlebih dahulu!");
            return false; // Mencegah pengiriman formulir jika tidak ada opsi yang dipilih
        }
        return true; // Memungkinkan pengiriman formulir jika opsi terpilih
    }
</script>