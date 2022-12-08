<?php 
    namespace App\Http\Controllers;
    use App\Http\Controllers\Controller;
    use App\Models\Users;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;

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
    }
?>