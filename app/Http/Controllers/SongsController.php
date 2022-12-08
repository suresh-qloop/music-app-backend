<?php 
    namespace App\Http\Controllers;
    use App\Http\Controllers\Controller;
    use App\Models\Songs;
    use App\Models\Users;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    class SongsController extends Controller
    {
            /**
         * Show the profile for the given user.
         *
         * @param  int  $id
         * @return Response
         */
        public function index()
        {
            return "Thanks for your reply!";
        }

        public function allSongs() {
            $songs = Songs::orderBy('id', 'DESC')->get();
            return $songs;
        }

        public function nowTrendings() {
            $nowTrendings = Songs::whereIn('id', array(728, 494, 619, 71, 854, 3006, 1050, 2951, 2137, 2152))->orderByRaw('FIELD(id, 728, 494, 619, 71, 854, 3006, 1050, 2951, 2137, 2152)')->get();
            return $nowTrendings;
        }

        public function allVideos() {
            $videos = Songs::where('video', 'true')->get();
            return $videos;
        }

        public function randomVideos() {
            $randVideos = Songs::where('video', 'true')->inRandomOrder()->limit(9)->get();
            return $randVideos;
        }

        public function distinctSongs() {
            // $distinctSongs = Songs::distinct('artist')->orderBy('artist')->get('artist');
            $distinctSongs = DB::select("SELECT DISTINCT artist FROM songs ORDER BY artist LIMIT 150");
            return $distinctSongs;
        }

        public function addNewSong(Request $request) {
            $insertNewSong = Songs::insert([
                'title' => $request->title,
                'artist' => $request->artist,
                'feat_artist' => $request->feat_artist,
                'producer' => $request->producer,
                'lyrics_by' => $request->lyrics_by,
                'year' => $request->year,
                'album' => $request->album,
                'genre' => $request->genre,
                'youtube_url' => $request->youtube_url,
                'soundcloud_url' => $request->soundcloud_url,
                'spotify_url' => $request->spotify_url,
                'video' => $request->video,
                'theme' => '',
                'views' => 0,
                'monthly_views' => 0,
                'insert_date' => '',
                'insert_user' => $request->author,
                'status' => 'pending',
                'edit_date' => '',
                'artist_id' => 0,
                'daily_views' => 0
            ]);
            $author = $request->author;
            $author_points = DB::table('users')->where('id', $author)->update(['total_pts' => $request->totalPoints*1 + 10]);
            
            return $insertNewSong;
        }

        public function updateSong(Request $request) {
            $updateSong = DB::table('songs')->where('id', $request->id)->update([
                'title' => $request->title,
                'artist' => $request->artist,
                'feat_artist' => $request->feat_artist,
                'producer' => $request->producer,
                'lyrics_by' => $request->lyrics_by,
                'year' => $request->year,
                'album' => $request->album,
                'genre' => $request->genre,
                'youtube_url' => $request->youtube_url,
                'soundcloud_url' => $request->soundcloud_url,
                'spotify_url' => $request->spotify_url,
                'video' => $request->video,
                'theme' => '',
                'views' => 0,
                'monthly_views' => 0,
                'insert_date' => '',
                'insert_user' => $request->author,
                'status' => 'pending',
                'edit_date' => '',
                'artist_id' => 0,
                'daily_views' => 0
            ]);

            return $updateSong;
        }
    }
?>