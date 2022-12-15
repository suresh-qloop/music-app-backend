<?php 
    namespace App\Http\Controllers;
    use App\Http\Controllers\Controller;
    use App\Models\Lyrics;
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
            $insertNewSong = Songs::insertGetId([
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
            if($insertNewSong && $request->lyrics){

                //$lines= explode("\n",$request->lyrics);
                
                foreach($request->lyrics as $line){
                    $line=trim($line['line_txt']);
                    // if (str_contains($line, '[') && str_contains($line, ']')) { 
                    //     $line=trim(str_replace('[', '', $line));
                    //     $line=trim(str_replace(']', '', $line));
                    // }                    

                    if($line !='' && $line!=null){
                        $lyrics = new Lyrics;
                        $lyrics->song_id = $insertNewSong;
                        $lyrics->line_txt = $line;
                        $lyrics->comment = 'false';
                        $lyrics->save();
                    }
                }
            }

            $author = $request->author;
            $author_points = DB::table('users')->where('id', $author)->update(['total_pts' => $request->totalPoints*1 + 10]);
            
            if($insertNewSong){
                return response()->json([
                    'success' => true,
                    'message' => 'Song Added Successfully.'
                ], 200);
            }
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

            if($request->lyrics_to_add){
                foreach($request->lyrics_to_add as $line){
                    $line=trim($line['line_txt']);                

                    if($line !='' && $line!=null){
                        $lyrics = new Lyrics;
                        $lyrics->song_id = $request->id;
                        $lyrics->line_txt = $line;
                        $lyrics->comment = 'false';
                        $lyrics->save();
                    }
                    $updateSong = true;
                }
            }

            if($request->lyrics_to_edit){
                foreach($request->lyrics_to_edit as $record){

                    $lyrics_edit= DB::table('lyrics_lines')->where('id', $record['id'])->update([
                        'line_txt' => $record['line_txt']
                    ]);
                    $updateSong = true;
                }
            }

            if($request->lyrics_to_remove){
                //echo "<pre>"; print_r($request->lyrics_to_remove);die;
                foreach($request->lyrics_to_remove as $record){

                    DB::table('lyrics_lines')->where('id', $record['id'])->delete();
                    $updateSong = true;
                }
            }

            if($updateSong){
                return response()->json([
                    'success' => true,
                    'message' => 'Song Updated Successfully.'
                ], 200);
            }
        }

        public function search(Request $request) {

            $search = $request->query('search_query');

            $result = DB::table('songs')
            ->where(DB::raw('lower(title)'), 'LIKE', "%".strtolower($search)."%")
            ->orWhere(DB::raw('lower(artist)'), 'LIKE', "%".strtolower($search)."%")
            ->orderBy('title')
            ->get();
            return $result;
        }

        public function browsByLetter(Request $request) {

            $search = $request->query('letter');

            $result = DB::table('songs')
            ->select('artist')
            ->where('artist', 'LIKE', "{$search}%")
            ->orderBy('artist')
            ->distinct()
            ->get();
            return $result;
        }
    }   
?>