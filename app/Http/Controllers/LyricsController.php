<?php 
    namespace App\Http\Controllers;
    use App\Http\Controllers\Controller;
    use App\Models\Lyrics;
    use Illuminate\Http\Request;

    class LyricsController extends Controller
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

        public function allLyricsLines(Request $request) {
            $lyrics_lines = Lyrics::where('song_id', $request->id)->get();
            return $lyrics_lines;
        }
    }
?>