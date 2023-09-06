<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ArtistVerifiedController;
use App\Http\Controllers\authController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\penggunaController;
use App\Http\Controllers\songController;
use App\Models\admin;
use App\Models\artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(authController::class)->group(function () {
    Route::get('/', 'viewWelcome')->name('masuk');
    Route::get('/masuk', 'viewMasuk')->name('pengguna');
    Route::get('/masuk-Admin', 'viewMasukAdmin')->name('admin');
    Route::get('/buat-akun', 'viewBuatAkun');
    Route::get('/lupa-password', 'viewLupaPassword')->name('lupaSandi');

    // operations datas
    Route::post('/validationSignIn', 'storeSignIn')->name('storeSignIn');
    Route::post('/validationSignUp', 'storeSignUp')->name('storeSignUp');

    // ubah password
    Route::get('/reset-password/{token}', 'resetPasswordToken')->name('password.reset');
    Route::post('/reset-password', 'resetPassword')->name('password.email');
    Route::post('/ubah-password', 'ubahPassword')->name('password.update');
})->middleware('guest');

Route::prefix('admin')->middleware('admin')->controller(AdminController::class)->group(function () {
    // Route::post('/validationSignInAdmin', 'storeSignIn')->name('storeSignIn.admin');

    Route::get('/dashboard', 'index')->name('admin.dashboard');
    Route::get('/persetujuan', 'persetujuan');
    Route::get('/kategori', 'kategori');
    Route::get('/iklan', 'iklan');
    Route::get('/riwayat', 'riwayat');
    Route::get('/verifikasi', 'verifikasi');
    Route::get('/show', 'show');
    Route::get('/hapus-billboard/{code}', 'hapusBillboard')->name('hapus.billoard');
    Route::get('/hapus-music/{code}', 'hapusMusic')->name('hapus.music');
    Route::get('/hapus-genre/{code}', 'hapusGenre')->name('hapus.genre');
    Route::get('/setuju-music/{code}', 'setujuMusic')->name('setuju.upload.music');

    Route::post('/hapus-verified/{code}', 'hapusVerified')->name('hapus.verified');
    Route::POST('/setuju-verified/{code}', 'setujuVerified')->name('tambah.verified');
    Route::post('/uploadBillboard', 'buatBillboard')->name('uploadBillboard');
    Route::post('/genre', 'buatGenre')->name('buat.genre');
    Route::post('/genre-edit', 'editGenre')->name('edit.genre');
    Route::post('/billboard-edit', 'editBillboard')->name('edit.billboard');

});

Route::post('/validationSIgnInAdmin', [AdminController::class, 'storeSignIn'])->name('storeSignIn.admin');

Route::prefix('artis')->middleware(['auth', 'artist'])->controller(ArtistController::class)->group(function () {
    Route::get('/kolaborasi', 'viewKolaborasi')->name('kolaborasi');
    Route::get('/lirik-chat/{code}', 'viewLirikAndChat')->name('lirikAndChat');
    Route::get('/show/{code}', 'showData')->name('project.show');
    Route::get('/logout', 'logout')->name('logout.artis');

    Route::get('/dashboard', 'index')->name('artist.dashboard');
    Route::get('/pencarian', 'pencarian');
    Route::get('/playlist', 'playlist');
    Route::get('/penghasilan', 'penghasilan');
    Route::get('/riwayat', 'riwayat');
    Route::get('/profile', 'profile');
    Route::get('/profile-ubah/{code}', 'profile_ubah')->name('ubah.profile.artis');
    Route::get('/detail-playlist/{code}', 'detailPlaylist')->name('detailPlaylistArtis');
    Route::get('/detail-album/{code}', 'detailAlbum')->name('detailAlbumArtis');
    Route::get('/unggahAudio', 'viewUnggahAudio');
    Route::get('/billboard/{code}', 'billboard')->name('detail.billboard');
    Route::get('/album', 'album');
    Route::get('/album-billboard/{code}', 'albumBillboard')->name('albumBillboard');
    Route::get('/kategori/{code}', 'kategori');
    Route::get('/buat-playlist', 'buatPlaylist');
    Route::get('/contoh-playlist', 'contohPlaylist');
    Route::get('/disukai-playlist', 'disukaiPlaylist');
    Route::get('/search', 'search')->name('search.artis');
    Route::get('/verified', 'verified');
    Route::get('/hapus-playlist/{code}', 'hapusPlaylist')->name('hapus.playlist.artis');
    Route::get('/hapus-album/{code}', 'hapusAlbum')->name('hapus.albums.artis');
    Route::get('/search_song', 'search_song')->name('search.song.artis');
    Route::get('/search/{code}', 'search_result');
    Route::get('/peraturan', function () {
        return view('artis.peraturan', ['title' => 'MusiCave']);
    })->name('peraturan.artis');

    Route::post('/tambah_playlist/{code}', 'tambah_playlist')->name('tambah.playlist.artis');
    Route::POST('/buat-album/{code}', 'buatAlbum')->name('tambah.album.artis');
    Route::POST('/verified/{code}', 'verifiedAccount')->name('verified');
    Route::post('/create-lirik', 'Project')->name('create.project');
    Route::post('/message', 'message')->name('message.project');
    Route::post('/reject-project', 'rejectProject')->name('reject.project.artis');
    Route::post('/buat-playlist', 'storePlaylist')->name('buat.playlist.artis');
    Route::post('/ubah-playlist/{code}', 'ubahPlaylist')->name('ubah.playlist.artis');
    Route::post('/ubah-album/{code}', 'ubahAlbum')->name('ubah.album.artis');
    Route::post('/update/profile/{code}', 'updateProfile')->name('update.profile.artis');
    Route::post('/unggahAudio', 'unggahAudio')->name('unggah.artis');
    // Route::post('/filter', 'filter')->name('filter');
});

Route::prefix('artis-verified')->middleware(['auth', 'artistVerified'])->controller(ArtistVerifiedController::class)->group(function () {
    // Route::get('/dashboard', 'viewDashboard');
    Route::get('/kolaborasi', 'viewKolaborasi')->name('artist-verified.kolaborasi');
    Route::get('/lirik-chat/{code}', 'viewLirikAndChat')->name('lirikAndChat.artisVerified');
    Route::get('/show/{code}', 'showData')->name('project.show.artisVerified');
    Route::get('/logout', 'logout')->name('logout.artisVerified');

    Route::get('/dashboard', 'index')->name('artist-verified.dashboard');
    Route::get('/detail-playlist/{code}', 'detailPlaylist')->name('detailPlaylistArtisVerified');
    Route::get('/detail-album/{code}', 'detailAlbum')->name('detailAlbumArtisVerified');
    Route::get('/unggahAudio', 'viewUnggahAudio');
    Route::get('/kategori/{code}', 'kategori');
    Route::get('/playlist', 'playlist');
    Route::get('/penghasilan', 'penghasilan');
    Route::get('/riwayat', 'riwayat');
    Route::get('/profile', 'profile');
    Route::get('/profile-ubah/{code}', 'profile_ubah')->name('ubah.profile.artisVerified');
    Route::get('/billboard/{code}', 'billboard')->name('detail.billboard.artisVerified');
    Route::get('/album', 'album');
    Route::get('/album-billboard/{code}', 'albumBillboard')->name('albumBillboard.artisVerified');
    Route::get('/kategori/{code}', 'kategori');
    Route::get('/search', 'search')->name('search.artisVerified');
    Route::get('/buat-playlist', 'buatPlaylist');
    Route::get('/contoh-playlist', 'contohPlaylist');
    Route::get('/disukai-playlist', 'disukaiPlaylist');
    Route::get('/hapus-playlist/{code}', 'hapusPlaylist')->name('hapus.playlist.artisVerified');
    Route::get('/peraturan', function () {
        return view('artisVerified.peraturan', ['title' => 'MusiCave']);
    })->name('peraturan.artisVerified');
    Route::post('/project', 'createProject')->name('createProject.artisVerified');
    Route::post('/unggahAudio', 'unggahAudio')->name('unggah.artisVerified');
    Route::post('/buat-album/{code}', 'buatAlbum')->name('tambah.album.artisVerified');
    Route::post('/buat-playlist', 'storePlaylist')->name('buat.playlist.artisVerified');
    Route::post('/ubah-playlist/{code}', 'ubahPlaylist')->name('ubah.playlist.artisVerified');
    Route::post('/update/profile/{code}', 'updateProfile')->name('update.profile.artisVerified');
    Route::post('/create-lirik', 'Project')->name('create.project.artisVerified');
    Route::post('/message', 'message')->name('message.project.artisVerified');
    Route::post('/reject-project', 'rejectProject')->name('reject.project.artisVerified');
    Route::post('/ubah-album/{code}', 'ubahAlbum')->name('ubah.album.artisVerified');
    Route::post('/update/profile/{code}', 'updateProfile')->name('update.profile.artisVerified');
    // Route::post('/unggahAudio', 'unggahAudio')->name('unggah.artisVerified');
});

Route::prefix('pengguna')->middleware(['auth', 'pengguna'])->controller(penggunaController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('user.dashboard');
    Route::get('/pencarian', 'pencarian');
    Route::get('/playlist', 'playlist');
    Route::get('/riwayat', 'riwayat');
    Route::get('/profile', 'profile');
    Route::get('/artis-search', 'searchArtis');
    Route::get('/song-search', 'searchSong');
    Route::get('/profile-ubah/{code}', 'profile_ubah')->name('ubah.profile');
    Route::get('/billboard/{code}', 'billboard')->name('detail.billboard.pengguna');
    Route::get('/album', 'album');
    Route::get('/kategori/{code}', 'kategori');
    Route::get('/buat-playlist', 'buatPlaylist');
    Route::get('/detail-playlist/{code}', 'detailPlaylist')->name('detailPlaylist');
    Route::get('/detail-album/{code}', 'detailAlbum')->name('detailAlbumPengguna');
    Route::get('/disukai-playlist', 'disukaiPlaylist');
    Route::get('/search', 'search')->name('search');
    Route::get('/logout', 'logout')->name('logout.users');
    Route::get('/toggle-like', 'like')->name('toggle-like');
    Route::get('/hapus-playlist/{code}', 'hapusPlaylist')->name('hapus.playlist.user');
    Route::get('/search_song', 'search_song')->name('search.song.pengguna');
    Route::get('/search/{code}', 'search_result');
    Route::get('/peraturan', function () {
        return view('users.peraturan', ['title' => 'MusiCave']);
    })->name('peraturan.pengguna');

    Route::post('/tambah_playlist/{code}', 'tambah_playlist')->name('tambah.playlist');
    Route::post('/update/profile/{code}', 'updateProfile')->name('update.profile');
    Route::post('/buat-playlist', 'storePlaylist')->name('buat.playlist');
    Route::post('/ubah-playlist/{code}', 'ubahPlaylist')->name('ubah.playlist');
    Route::post('/filter', 'filter')->name('filter');
});

Route::controller(SongController::class)->group(function () {
    Route::post('/song/{song}/like', 'toggleLike');
    Route::get('/ambil-lagu', 'ambillagu');
    Route::post('/update-play-count/{song_id}', 'playCount');
    Route::get('/get-song-like-status/{song}', 'songLikeStatus');
});
