<?php 
    namespace App\Http\Controllers;
    use App\Http\Controllers\Controller;
    use App\Models\Artists;

    class ArtistsController extends Controller
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

        public function allArtists() {
            $artists = Artists::where('pic_name', '<>', "")->inRandomOrder()->get();
            return $artists;
        }
    }
?>