<?php 
    namespace App\Http\Controllers;
    use App\Http\Controllers\Controller;
    use App\Models\Articles;

    class ArticlesController extends Controller
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

        public function allArticles() {
            $articles = Articles::where('preview', "true")->orderBy('insert_date', 'DESC')->get();
            return $articles;
        }
    }
?>