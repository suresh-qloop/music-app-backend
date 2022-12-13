<?php 

namespace App\Http\Controllers;
    use App\Http\Controllers\Controller;
    use App\Models\Users;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;


    class UsersController extends Controller
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

        public function allUsers() {
            $songs = Users::orderBy('total_pts', 'DESC')->get();
            return $songs;
        }
        
        public function store(Request $request) {
            $password = Hash::make($request->pwd);
            $this->validate(request(), [
                'username' => 'required',
                'email' => 'required|email',
                'pwd' => 'required', 
                'reg_date' => 'required',
                'latest_pts' => 'required',
                'total_pts' => 'required',
                'lat_pts_date' => 'required',
            ]);
            
            $data=$request->all();
            $data['pwd'] = Hash::make($request->pwd);
            $status=Users::create($data);
            session(['login' => true]);
            return $request->session()->all();
        }

        public function checkLogin(Request $request) {
            $email = $request->email;
            $pwd = Hash::make($request->pwd);
            $isLogin = Users::where('email', $email)->get();
            return $isLogin;
        }

        public function resetPassword(Request $request) {

            $validator = Validator::make($request->all(), [
                'author' => 'required',
                'old_password' => 'required',
                'new_password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                  'errors' => $validator->errors(),
                  'status' => Response::HTTP_BAD_REQUEST,
                ], Response::HTTP_BAD_REQUEST);
            }


            $user_id = $request->author;
            $old_password = $request->old_password;
            $new_password = $request->new_password;

            $user_password=Users::select('pwd')->where('id',$user_id)->first();
            $password=$user_password['pwd'];

            if (!Hash::check($old_password, $password)) {
                 return response()->json(['error' => 'Current password you entered is Incorrect'],400);
            }
            else{
                $user = Users::find($user_id);
                $user->pwd = Hash::make($new_password);
                if($user->Update()){
                    return response()->json([
                        'success' => true,
                        'message' => 'Password Changed Successfully.'
                    ], 200);
                }
                else{
                    return response()->json(['error' => 'Error in Updation!'],400);
                }
             }
           
        }
    }
?>