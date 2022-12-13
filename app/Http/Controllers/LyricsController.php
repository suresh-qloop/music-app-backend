<?php 
    namespace App\Http\Controllers;
    use App\Http\Controllers\Controller;
    use App\Models\Lyrics;
    use App\Models\UserNotes;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\Validator;

    use Illuminate\Support\Facades\Storage;


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

        public function addExplanation(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'author' => 'required',
                'line_number' => 'required',
                'song_id' => 'required',
                'explanation' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                  'errors' => $validator->errors(),
                  'status' => Response::HTTP_BAD_REQUEST,
                ], Response::HTTP_BAD_REQUEST);
            }

            $file='false';
            $file_url='';
            $file_name = null;
            if ($request->has('file')) {

               // echo "<pre>"; print_r($request->file);die;
                $path = "images/";
    
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $extension= $request->file->extension();
                $valid_file_extensions=array("jpg", "jpeg", "png", "pdf");
                if(!in_array($extension,$valid_file_extensions)){
                    return response()->json(['error' => 'Please Choose Valid Image or PDF File!'],400);
                }
    
                $file_name = rand(0, 999999999) . '.' . $extension;
                $request->file->move(public_path($path), $file_name);
                $file='true';
                $file_url=$path.$file_name;
            }

            $explanation = new UserNotes;
            $explanation->author = $request->author;
            $explanation->song_id = $request->song_id;
            $explanation->line_id = $request->line_number;
            $explanation->insert_date = time();
            $explanation->annotation = trim($request->explanation);
            $explanation->file = $file;
            $explanation->file_path =$file_url;
            $explanation->status ='pending';
    
            if($explanation->save()){
                return response()->json([
                    'success' => true,
                    'message' => 'Explanation Added.'
                ], 200);
            }
        }
    }
?>