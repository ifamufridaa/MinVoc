<?php

namespace App\Http\Controllers;

use App\Models\album;
use App\Models\artist;
use App\Models\billboard;
use App\Models\genre;
use App\Models\messages;
use App\Models\playlist;
use App\Models\projects;
use App\Models\song;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use getID3;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class ArtistController extends Controller
{
    protected function index(): Response
    {
        $title = "MusiCave";
        $songs = song::all();
        $genres = genre::all();
        $artist = artist::with('user')->get();
        $playlists = playlist::all();
        $billboards = billboard::all();
        return response()->view('artis.dashboard', compact('title', 'songs', 'genres', 'artist', 'billboards', 'playlists'));
    }

    protected function playlist(): Response
    {
        $title = "MusiCave";
        $playlists = playlist::all();
        $albums = album::all();
        return response()->view('artis.playlist', compact('title', 'playlists', 'albums'));
    }

    protected function penghasilan(): Response
    {
        $title = "MusiCave";
        $totalPengguna = User::count();
        $totalLagu = song::count();
        $totalArtist = artist::count();
        $songs = song::all();
        return response()->view('artis.penghasilan', compact('title', 'totalPengguna', 'totalLagu', 'totalArtist', 'songs'));
    }

    protected function riwayat(): Response
    {
        $title = "MusiCave";
        return response()->view('artis.riwayat', compact('title'));
    }

    protected function profile(): Response
    {
        $title = "MusiCave";
        return response()->view('artis.profile.profile', compact('title'));
    }

    protected function profile_ubah(string $code): Response
    {
        $title = "MusiCave";
        $user = User::where('code', $code)->get();
        return response()->view('artis.profile.profile_ubah', compact('title', 'user'));
    }

    protected function tambah_playlist(string $code, Request $request)
    {
        $song = song::where('code', $code)->first();
        try {
            $song->playlist_id = $request->input('playlist_id');
            $song->update();
        } catch (\Throwable $th) {
            return back();
        }
        return back();
    }

    protected function buatAlbum(Request $request, string $code)
    {
        $user = User::where('code', $code)->first();
        $artist = Artist::where('user_id', $user->id)->first();

        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'name' => [
                    'required' => 'Nama harus diisi.',
                    'string' => 'Nama harus berupa teks.',
                    'max' => 'Nama tidak boleh lebih dari :max karakter.',
                ],
                'image' => [
                    'image' => 'image harus berupa gambar.',
                    'mimes' => 'image harus dalam format: :values.',
                    'max' => 'image tidak boleh lebih dari :max KB.',
                ],
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        try {
            $imagePath = $request->file('image')->store('images', 'public');

            album::create([
                'code' => Str::uuid(),
                'artis_id' => $artist->id,
                'name' => $request->input('name'),
                'image' => $imagePath,
            ]);
            $title = "MusiCave";
            $playlists = playlist::all();
            $albums = album::all();
        } catch (\Throwable $th) {
            return response()->view('artis.playlist', compact('title', 'playlists', 'albums'));
        }
        return response()->view('artis.playlist', compact('title', 'playlists', 'albums'));
    }

    protected function verifiedAccount(string $code, Request $request)
    {
        $user = User::where('code', $code)->first();
        $artist = Artist::where('user_id', $user->id)->first();

        $validate = Validator::make(
            $request->all(),
            [
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'foto' => [
                    'image' => 'foto harus berupa gambar.',
                    'mimes' => 'foto harus dalam format: :values.',
                    'max' => 'foto tidak boleh lebih dari :max KB.',
                ],
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        try {
            $imagePath = $request->file('foto')->store('images', 'public');

            $artist->pengajuan_verified_at = now()->toDateString();
            $artist->image = $imagePath;
            $artist->save();
        } catch (\Throwable $th) {
            Alert::error('message', 'Gagal Mengirim Request Verification Account');
            return response()->redirectTo('/artis/verified')->with('failed', "failed");
        }
        Alert::success('message', 'Success Mengirim Request Verification Account');
        return response()->redirectTo('/artis/verified')->with('message', "success");
    }

    protected function updateProfile(string $code, Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'email' => 'required|string|email|max:255',
                'deskripsi' =>  'max:500',
            ],
            [
                'name' => [
                    'required' => 'Nama harus diisi.',
                    'string' => 'Nama harus berupa teks.',
                    'max' => 'Nama tidak boleh lebih dari :max karakter.',
                ],
                'avatar' => [
                    'image' => 'Avatar harus berupa gambar.',
                    'mimes' => 'Avatar harus dalam format: :values.',
                    'max' => 'Avatar tidak boleh lebih dari :max KB.',
                ],
                'email' => [
                    'required' => 'Email harus diisi.',
                    'string' => 'Email harus berupa teks.',
                    'email' => 'Format email tidak valid.',
                    'max' => 'Email tidak boleh lebih dari :max karakter.',
                ],
                'deskripsi' => [
                    'max' => 'Deskripsi tidak boleh lebih dari :max karakter.',
                ],
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        $user = User::where('code', $code)->first();
        $existingPhotoPath = $user->avatar;

        if ($request->hasFile('avatar') && $request->file('avatar')) {
            if ($validate->fails()) {
                return redirect()->back()
                    ->withErrors($validate)
                    ->withInput();
            }


            if (Storage::disk('public')->exists($existingPhotoPath) == "images/default.png") {
                $newImage = $request->file('avatar')->store('images', 'public');
            } else if (Storage::disk('public')->exists($existingPhotoPath)) {
                Storage::disk('public')->delete($existingPhotoPath);
                $newImage = $request->file('avatar')->store('images', 'public');
            }

            if ($request->input('deskripsi') === "none" || $request->input('deskripsi') === null) {
                $value = [
                    'code' => $code,
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'deskripsi' => "none",
                    'avatar' => $newImage,
                    'password' => $user->password,
                    'role_id' => $user->role_id,
                ];
            } else {
                $value = [
                    'code' => $code,
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'deskripsi' => $request->input('deskripsi'),
                    'avatar' => $newImage,
                    'password' => $user->password,
                    'role_id' => $user->role_id,
                ];
            }
        } else {
            if ($request->input('deskripsi') === "none" || $request->input('deskripsi') === null) {
                $value = [
                    'code' => $code,
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'deskripsi' => "none",
                    'password' => $user->password,
                    'role_id' => $user->role_id,
                ];
            } else {
                $value = [
                    'code' => $code,
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'deskripsi' => $request->input('deskripsi'),
                    'password' => $user->password,
                    'role_id' => $user->role_id,
                ];
            }
        }
        try {
            User::where('code', $code)->update($value);
        } catch (Throwable $e) {
            return response()->redirectTo('/artis/profile')->with('failed', "failed");
        }
        return response()->redirectTo('/artis/profile')->with('failed', "failed");
    }

    protected function hapusPlaylist(string $code)
    {
        $playlist = Playlist::where('code', $code)->first();

        if (!$playlist) {
            return response()->redirectTo('artis/playlist');
        }

        try {
            if (Storage::disk('public')->exists($playlist->images)) {
                Storage::disk('public')->delete($playlist->images);
            }
            $playlist->delete();
        } catch (\Throwable $th) {
            Log::error('Error deleting playlist: ' . $th->getMessage());
            return response()->redirectTo('artis/playlist');
        }


        return response()->redirectTo('artis/playlist');
    }

    protected function hapusAlbum(string $code)
    {
        $album = album::where('code', $code)->first();

        if (!$album) {
            return response()->redirectTo('artis/album');
        }

        try {
            if (Storage::disk('public')->exists($album->image)) {
                Storage::disk('public')->delete($album->image);
            }
            $album->delete();
        } catch (\Throwable $th) {
            Log::error('Error deleting playlist: ' . $th->getMessage());
            return response()->redirectTo('artis/playlist');
        }

        return response()->redirectTo('artis/playlist');
    }

    protected function viewUnggahAudio(Request $request): Response
    {
        $title = "Unggah Audio";
        $datas = song::with('artist')->get();
        $genres = genre::all();
        $albums = album::all();
        return response()->view('artis.unggahAudio', compact('title', 'datas', 'genres', 'albums'));
    }

    protected function unggahAudio(Request $request)
    {
        $validator = Validator::make($request->only('image', 'judul', 'audio', 'genre', 'album'), [
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'judul' => 'required|string|max:255',
            'audio' => 'required|mimetypes:audio/mpeg,audio/wav|max:20480',
            'genre' => 'required|string|max:255',
            'album' => 'string|max:255',
        ], [
            'image.image' => 'File :attribute harus berupa gambar.',
            'image.mimes' => 'File :attribute harus berupa file gambar dengan tipe: :values.',
            'image.max' => 'File :attribute tidak boleh lebih dari :max kilobita.',
            'judul.required' => 'Kolom :attribute harus diisi.',
            'judul.string' => 'Kolom :attribute harus berupa teks.',
            'judul.max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'audio.required' => 'Kolom :attribute harus diisi.',
            'audio.mimetypes' => 'File :attribute harus berupa file audio dengan tipe: :values.',
            'audio.max' => 'File :attribute tidak boleh lebih dari :max kilobita.',
            'genre.required' => 'Kolom :attribute harus diisi.',
            'genre.string' => 'Kolom :attribute harus berupa teks.',
            'genre.max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        try {
            DB::beginTransaction();
            $code = Str::uuid();
            $image = $request->file('image')->store('images', 'public');
            $audio = $request->file('audio')->store('musics', 'public');

            $getID3 = new getID3();

            $audioInfo = $getID3->analyze($request->file('audio')->path());
            $durationInSeconds = $audioInfo['playtime_seconds'];
            $durationMinutes = floor($durationInSeconds / 60);
            $durationSeconds = $durationInSeconds % 60;
            $formattedDuration = sprintf('%02d:%02d', $durationMinutes, $durationSeconds);

            $artis = artist::where('user_id', Auth::user()->id)->first();

            song::create([
                'code' => $code,
                'judul' => $request->input('judul'),
                'image' => $image,
                'audio' => $audio,
                'waktu' => $formattedDuration,
                'is_approved' => false,
                'genre_id' => $request->input('genre'),
                'album_id' => $request->input('album') == null ? null : $request->input('album'),
                'artis_id' => $artis->id,
            ]);
            DB::commit();

            // Alert::success('message', 'Berhasil Mengunggah Lagu');
            return redirect('/artis/unggahAudio')->with('success', 'Song uploaded successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Error uploading song: ' . $e->getMessage());
            // Alert::error('message', 'Gagal Mengunggah Lagu');
            return redirect('/artis/unggahAudio')->with('error', 'Failed to upload song. Please try again later.');
        }
    }


    protected function billboard(string $code): Response
    {
        $title = "MusiCave";
        $billboard = billboard::where('code', $code)->first();
        $albums = album::where('artis_id', $billboard->artis_id)->get();
        $songs = song::all();
        return response()->view('artis.billboard.billboard', compact('title', 'billboard', 'albums', 'songs'));
    }

    protected function albumBillboard(string $code): Response
    {
        $title = "MusiCave";
        $album = album::where('code', $code)->first();
        return response()->view('artis.billboard.album', compact('title', 'album'));
    }

    protected function album(): Response
    {
        $title = "MusiCave";
        return response()->view('artis.billboard.album', compact('title'));
    }

    protected function kategori(string $code): Response
    {
        $title = "MusiCave";
        $genre = genre::where('code', $code)->first();
        $playlists = playlist::all();
        $songs = song::where('genre_id', $genre->id)->get();
        return response()->view('artis.kategori.kategori', compact('title', 'genre', 'songs', 'playlists'));
    }

    protected function buatPlaylist(): Response
    {
        $title = "MusiCave";
        $songs = song::all();
        return response()->view('artis.playlist.buat', compact('title', 'songs'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $songs = Song::where('judul', 'LIKE', '%' . $query . '%')->get();

        $artists = User::where('name', 'LIKE', '%' . $query . '%')->get();

        $results = [
            'songs' => $songs,
            'artists' => $artists,
        ];
        // $results = User::where('name', 'LIKE', '%' . $query . '%')->get();
        return response()->json(['results' => $results]);
    }

    public function search_song(Request $request)
    {
        $query = $request->input('query');
        $results = song::with('artist.user')->where('judul', 'like', '%' . $query . '%')->get();

        return response()->json(['results' => $results]);
    }

    public function search_result(Request $request, string $code)
    {
        $title = "MusiCave";
        $song = song::where('code', $code)->first();
        $user = user::where('code', $code)->first();
        $playlists = playlist::all();
        $songAll = song::all();

        if ($song) {
            return view('artis.search.songSearch', compact('song', 'title', 'songAll', 'playlists'));
        } else if ($user) {
            $songUser = song::where('artis_id', $user->id)->get();
            return view('artis.search.artisSearch', compact('user', 'title', 'songUser', 'playlists'));
        }
    }

    public function verified(Request $request)
    {
        $title = "MusiCave";
        return response()->view('artis.verified', compact('title'));
    }

    protected function storePlaylist(Request $request): Response
    {
        $title = "MusiCave";
        try {
            if (!$request->file()) {
                $values =
                    [
                        'code' => Str::uuid(),
                        'name' => $request->input('name') == null ? "Playlist Lagu" : $request->input('name'),
                        'deskripsi' => $request->input('deskripsi') == null ? "none" : $request->input('deskripsi'),
                        'images' => 'images/defaultPlaylist.png',
                        'user_id' => Auth::user()->id
                    ];
            } else if ($existImage = $request->file('images')->store('images', 'public')) {
                $values =
                    [
                        'code' => Str::uuid(),
                        'name' => $request->input('name') == null ? "Playlist Lagu" : $request->input('name'),
                        'deskripsi' => $request->input('deskripsi') == null ? "none" : $request->input('deskripsi'),
                        'images' => $existImage,
                        'user_id' => Auth::user()->id
                    ];
            }
            playlist::create($values);
            $playlists = playlist::all();
        } catch (\Throwable $th) {
            return response()->view('artis.playlist', compact('title'));
        }
        return response()->view('artis.playlist', compact('title', 'playlists'));
    }

    protected function ubahPlaylist(Request $request, string $code)
    {
        $title = "MusiCave";
        $playlists = playlist::where('code', $code)->first();
        try {
            if (!$request->file()) {
                $values =
                    [
                        'code' => $code,
                        'name' => $request->input('name') == null ? $playlists->name : $request->input('name'),
                        'deskripsi' => $request->input('deskripsi') == null ? $playlists->deskripsi : $request->input('deskripsi'),
                        'images' => $playlists->images,
                        'user_id' => $playlists->user_id
                    ];
            } else if ($existImage = $request->file('images')->store('images', 'public')) {
                if (Storage::disk('public')->exists($playlists->images)) {
                    Storage::disk('public')->delete($playlists->images);
                }

                $values =
                    [
                        'code' => $code,
                        'name' => $request->input('name') == null ? $playlists->name : $request->input('name'),
                        'deskripsi' => $request->input('deskripsi') == null ? $playlists->deskripsi : $request->input('deskripsi'),
                        'images' => $existImage,
                        'user_id' => $playlists->user_id
                    ];
            }
            playlist::where('code', $code)->update($values);
            $playlists = playlist::all();
        } catch (\Throwable $th) {
            return response()->view('artis.playlist', compact('title'));
        }
        return response()->view('artis.playlist', compact('title', 'playlists'));
    }

    protected function ubahAlbum(Request $request, string $code)
    {
        $title = "MusiCave";
        $album = album::where('code', $code)->first();
        try {
            if (!$request->file()) {
                $values =
                    [
                        'code' => $code,
                        'name' => $request->input('name') == null ? $album->name : $request->input('name'),
                        'image' => $album->image,
                        'artis_id' => $album->artis->user_id
                    ];
            } else if ($existImage = $request->file('image')->store('images', 'public')) {
                if (Storage::disk('public')->exists($album->image)) {
                    Storage::disk('public')->delete($album->image);
                }

                $values =
                    [
                        'code' => $code,
                        'name' => $request->input('name') == null ? $album->name : $request->input('name'),
                        'image' => $existImage,
                        'artis_id' => $album->artis->user_id
                    ];
            }
            $album->update($values);
            $album = album::all();
        } catch (\Throwable $th) {
            return response()->view('artis.playlist', compact('title'));
        }
        return response()->view('artis.playlist', compact('title', 'album'));
    }

    protected function detailPlaylist(string $code): Response
    {
        $playlistDetail = playlist::where('code', $code)->first();
        $songs = song::where('playlist_id', $playlistDetail->id)->get();
        $playlists = playlist::all();
        $title = "MusiCave";
        return response()->view('artis.playlist.contoh', compact('title', 'playlistDetail', 'songs', 'playlists'));
    }

    protected function detailAlbum(string $code): Response
    {
        $albumDetail = album::where('code', $code)->first();
        $songs = song::all();
        $playlists = playlist::all();
        $title = "MusiCave";
        return response()->view('artis.playlist.contohAlbum', compact('title', 'albumDetail', 'songs', 'playlists'));
    }

    protected function contohPlaylist(): Response
    {
        $title = "MusiCave";
        return response()->view('artis.playlist.contoh', compact('title'));
    }

    protected function disukaiPlaylist(): Response
    {
        $title = "MusiCave";
        return response()->view('artis.playlist.disukai', compact('title'));
    }

    protected function viewKolaborasi(Request $request)
    {
        $title = "Kolaborasi";
        $datas = projects::all();
        return response()->view('artis.kolaborasi', compact('title', 'datas'));
    }

    protected function viewLirikAndChat(Request $request, string $code)
    {
        $title = "Kolaborasi";
        $project = DB::table('projects')->where('code', $code)->first();
        $artis = artist::where('user_id', auth()->user()->id)->first();
        $datas = messages::with('messages')->get();
        try {
            projects::where('code', $project->code)->update(['penerima_project' => $artis->id]);
        } catch (\Throwable $th) {
            return response()->view('artis.lirikAndChat', compact('title', 'project', 'datas'));
        }
        return response()->view('artis.lirikAndChat', compact('title', 'project', 'datas'));
    }

    protected function showData(string $id)
    {
        $data = DB::table('projects')->where('code', $id)->get();
        return response()->view('artis.kolaborasi', compact('data'));
    }

    protected function logout(Request $request)
    {
        Auth::logout();
        return response()->redirectTo("/masuk");
    }

    protected function Project(Request $request)
    {
        $validate = Validator::make(
            $request->only('judul', 'lirik', 'code'),
            [
                'judul' => 'required|string|max:255',
                'lirik' => 'required|string',
                'code' => [
                    'required',
                    Rule::in([$request->input('code')]),
                ]
            ],
            [
                'required' => 'Kolom :attribute harus diisi.',
                'string' => 'Kolom :attribute harus berupa teks.',
                'max' => [
                    'string' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
                ],
                'in' => 'Kolom :attribute tidak valid.',
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        $project = projects::where('code', $request->input('code'))->first();

        $data = [
            'code' => $project->code,
            'name' => $project->name,
            'judul' => $request->input('judul'),
            'lirik' => $request->input('lirik'),
            'konsep' => $project->konsep,
            'harga' => $project->harga,
            'artist_id' => Auth::user()->id,
            'is_approved' => false,
            'is_reject' => false,
        ];

        try {
            $project->update($data);
        } catch (Throwable $e) {
            return response()->redirectTo('/artis/kolaborasi')->with('message', "Gagal untuk register!!");
        }
        return response()->redirectTo('/artis/kolaborasi')->with('message', 'User created successfully.');
    }

    protected function message(Request $request)
    {
        $project = projects::where('id', $request->input('id_project'))->first();
        $user = artist::where('id', auth()->user()->id)->first();
        $message = messages::create([
            'code' => Str::uuid(),
            'sender_id' => $project->pembuat_project,
            'receiver_id' => $project->penerima_project,
            'project_id' => $project->id,
            'message' => $request->input('message')
        ]);
        $data = messages::with('messages')->get();
        try {
        } catch (\Throwable $th) {
            return redirect()->back();
        }

        return redirect()->back()->with([
            'message' => $message->message,
            'datas' => $data
        ]);
    }

    protected function rejectProject(Request $request)
    {
        $project = projects::where('code', $request->input('code'))->first();
        // dd($project);
        try {
            $data = [
                'code' => $project->code,
                'name' => $project->name,
                'genre' => $project->genre,
                'judul' => "none",
                'lirik' => "none",
                'konsep' => $project->konsep,
                'harga' => $project->harga,
                'artist_id' => Auth::user()->id,
                'is_approved' => false,
                'is_reject' => true,
            ];
            $project->update($data);
        } catch (\Throwable $th) {
            return redirect()->back();
        }
        return redirect()->back();
    }

    protected function createProject(Request $request)
    {
        $validate = Validator::make(
            $request->only('name', 'konsep'),
            [
                'name' => 'required|string|max:255|min:1',
                'konsep' => 'required|string|max:500|min:1',
            ],
            [
                'required' => 'Kolom :attribute harus diisi.',
                'string' => 'Kolom :attribute harus berupa teks.',
                'max' => [
                    'string' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
                ],
                'numeric' => 'Kolom :attribute harus berupa angka.',
                'min' => [
                    'numeric' => 'Kolom :attribute harus lebih besar atau sama dengan :min.',
                ],
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        try {
            $code = Str::uuid();
            projects::create(
                [
                    'code' => $code,
                    'name' => $request->input('name'),
                    'konsep' => $request->input('konsep'),
                    'judul' => "none",
                    'lirik' => "none",
                    'artist_id' => 0,
                    'is_approved' => false,
                    'is_reject' => false,
                ]
            );
        } catch (Throwable $e) {
            return response()->redirectTo('/artis/kolaborasi')->with('message', "Gagal untuk register!!");
        }
        return response()->redirectTo('/artis/kolaborasi')->with('message', 'User created successfully.');
    }
}
