<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Menu;
use App\Offer;
use App\Slider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Config;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $slider = Slider::where('status',true)->where('parent_id',null)->first();
        $sliders = Slider::where('parent_id',$slider->id)->get();

        $offer = Offer::where('status',true)->where('parent_id',null)->first();
        $offers = Offer::where('parent_id',$offer->id)->get();


        $sabBanners = Banner::where('target','shopAtBravo')->where('status',true)->orderBy('order')->get();

        $abbBanners = Banner::where('target','aboveBravoBanner')->where('status',true)->orderBy('order')->get();
        $bbBanners = Banner::where('target','bravoBanner')->where('status',true)->orderBy('order')->get();
        $bbbBanners = Banner::where('target','belowBravoBanner')->where('status',true)->orderBy('order')->get();

        $mediaBanners = Banner::where('target','media')->where('status',true)->orderBy('order')->get();
        return view('front.app.index',compact('sliders','offers','sabBanners','abbBanners','bbBanners','bbbBanners','mediaBanners'));
    }

    public function product()
    {
        return view('front.product');
    }

    public function setLocale($language='az'){
        App::setLocale($language);
        Session::put('language',$language);
        return redirect()->back();
    }

    public function apiLogin(Request $request){
        $login = Auth::attempt($request->all());

        return response()->json([
            "status" => $login,
        ],200,[],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }

    public function apiGetUsers(){
//        $users = config('users');
//        return response()->json($users,200,[],JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
        $userData = [];
        $users = User::all();
        foreach ($users as $user){
            $user->role = $user->roles[0]->name;
            unset($user->roles);
            $userData[] = $user;
        }
        return response()->json($users,200,[],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }

    public function apiGetUser($user_id){
//        $users = config('users');
//        $returnData = null;
//        foreach ($users as $userId => $user){
//            if($user_id==$user['userId']){
//                $returnData = $user;
//            }
//        }
        $user = User::find($user_id);
        return response()->json($user,200,[],JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    }

    public function apiGetPosts($user_id){
        $allPosts = config('posts');
        $userPosts = [];
        foreach ($allPosts as $userId => $post){
            if($userId == $user_id){
                $userPosts[$user_id] = $post;
            }
        }
        $returnposts = ['posts' => $userPosts];
        return response()->json($returnposts,200,[],JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    }


    public function generateData(){
        $firstNames = ["Smith","Johnson","Williams","Brown","Jones","Miller","Davis","Garcia","Rodriguez","Wilson","Martinez","Anderson","Taylor","Thomas","Hernandez","Moore","Martin","Jackson","Thompson","White","Lopez","Lee","Gonzalez","Harris","Clark","Lewis","Robinson","Walker","Perez","Hall","Young","Allen","Sanchez","Wright","King","Scott","Green","Baker","Adams","Nelson","Hill","Ramirez","Campbell","Mitchell","Roberts","Carter","Phillips","Evans","Turner","Torres","Parker","Collins","Edwards","Stewart","Flores","Morris","Nguyen","Murphy","Rivera","Cook","Rogers","Morgan","Peterson","Cooper","Reed","Bailey","Bell","Gomez","Kelly","Howard","Ward","Cox","Diaz","Richardson","Wood","Watson","Brooks","Bennett","Gray","James","Reyes","Cruz","Hughes","Price","Myers","Long","Foster","Sanders","Ross","Morales","Powell","Sullivan","Russell","Ortiz","Jenkins","Gutierrez","Perry","Butler","Barnes","Fisher","Henderson","Coleman","Simmons","Patterson","Jordan","Reynolds","Hamilton","Graham","Kim","Gonzales","Alexander","Ramos","Wallace","Griffin","West","Cole","Hayes","Chavez","Gibson","Bryant","Ellis","Stevens","Murray","Ford","Marshall","Owens","Mcdonald","Harrison","Ruiz","Kennedy","Wells","Alvarez","Woods","Mendoza","Castillo","Olson","Webb","Washington","Tucker","Freeman","Burns","Henry","Vasquez","Snyder","Simpson","Crawford","Jimenez","Porter","Mason","Shaw","Gordon","Wagner","Hunter","Romero","Hicks","Dixon","Hunt","Palmer","Robertson","Black","Holmes","Stone","Meyer","Boyd","Mills","Warren","Fox","Rose","Rice","Moreno","Schmidt","Patel","Ferguson","Nichols","Herrera","Medina","Ryan","Fernandez","Weaver","Daniels","Stephens","Gardner","Payne","Kelley","Dunn","Pierce","Arnold","Tran","Spencer","Peters","Hawkins","Grant","Hansen","Castro","Hoffman","Hart","Elliott","Cunningham","Knight","Bradley","Carroll","Hudson","Duncan","Armstrong","Berry","Andrews","Johnston","Ray","Lane","Riley","Carpenter","Perkins","Aguilar","Silva","Richards","Willis","Matthews","Chapman","Lawrence","Garza","Vargas","Watkins","Wheeler","Larson","Carlson","Harper","George","Greene","Burke","Guzman","Morrison","Munoz","Jacobs","Obrien","Lawson","Franklin","Lynch","Bishop","Carr","Salazar","Austin","Mendez","Gilbert","Jensen","Williamson","Montgomery","Harvey","Oliver","Howell","Dean","Hanson","Weber","Garrett","Sims","Burton","Fuller","Soto","Mccoy","Welch","Chen","Schultz","Walters","Reid","Fields"];
        $lastNames = ["Smith","Johnson","Williams","Brown","Jones","Miller","Davis","Garcia","Rodriguez","Wilson","Martinez","Anderson","Taylor","Thomas","Hernandez","Moore","Martin","Jackson","Thompson","White","Lopez","Lee","Gonzalez","Harris","Clark","Lewis","Robinson","Walker","Perez","Hall","Young","Allen","Sanchez","Wright","King","Scott","Green","Baker","Adams","Nelson","Hill","Ramirez","Campbell","Mitchell","Roberts","Carter","Phillips","Evans","Turner","Torres","Parker","Collins","Edwards","Stewart","Flores","Morris","Nguyen","Murphy","Rivera","Cook","Rogers","Morgan","Peterson","Cooper","Reed","Bailey","Bell","Gomez","Kelly","Howard","Ward","Cox","Diaz","Richardson","Wood","Watson","Brooks","Bennett","Gray","James","Reyes","Cruz","Hughes","Price","Myers","Long","Foster","Sanders","Ross","Morales","Powell","Sullivan","Russell","Ortiz","Jenkins","Gutierrez","Perry","Butler","Barnes","Fisher","Henderson","Coleman","Simmons","Patterson","Jordan","Reynolds","Hamilton","Graham","Kim","Gonzales","Alexander","Ramos","Wallace","Griffin","West","Cole","Hayes","Chavez","Gibson","Bryant","Ellis","Stevens","Murray","Ford","Marshall","Owens","Mcdonald","Harrison","Ruiz","Kennedy","Wells","Alvarez","Woods","Mendoza","Castillo","Olson","Webb","Washington","Tucker","Freeman","Burns","Henry","Vasquez","Snyder","Simpson","Crawford","Jimenez","Porter","Mason","Shaw","Gordon","Wagner","Hunter","Romero","Hicks","Dixon","Hunt","Palmer","Robertson","Black","Holmes","Stone","Meyer","Boyd","Mills","Warren","Fox","Rose","Rice","Moreno","Schmidt","Patel","Ferguson","Nichols","Herrera","Medina","Ryan","Fernandez","Weaver","Daniels","Stephens","Gardner","Payne","Kelley","Dunn","Pierce","Arnold","Tran","Spencer","Peters","Hawkins","Grant","Hansen","Castro","Hoffman","Hart","Elliott","Cunningham","Knight","Bradley","Carroll","Hudson","Duncan","Armstrong","Berry","Andrews","Johnston","Ray","Lane","Riley","Carpenter","Perkins","Aguilar","Silva","Richards","Willis","Matthews","Chapman","Lawrence","Garza","Vargas","Watkins","Wheeler","Larson","Carlson","Harper","George","Greene","Burke","Guzman","Morrison","Munoz","Jacobs","Obrien","Lawson","Franklin","Lynch","Bishop","Carr","Salazar","Austin","Mendez","Gilbert","Jensen","Williamson","Montgomery","Harvey","Oliver","Howell","Dean","Hanson","Weber","Garrett","Sims","Burton","Fuller","Soto","Mccoy","Welch","Chen","Schultz","Walters","Reid","Fields"];
        $addresses = ["2136 PALISADES DR","5220 KNIGHT DR","12588 DELORES DR","1033 ROMAN DR","18367 EDNIE LN","14261 JEFFERSON HWY","8926 FOXGATE DR","19128 VIGNES LAKE AVE","1809 WISTERIA ST","13441 TIGER BEND RD","4618 MENDOCINO WAY", "13836 MALBEC AVE","3422 BRENTWOOD DR","9456 HOMESTEAD DR","1292 N 37TH ST","21570 PORT HICKEY RD",];
        $roles = ['Chairman','Adminstrator','Owner','CEO','CTO','CFO','Founder','Operator','User','Consumer','Saler'];
        $users = [];
        $posts = [];
        for($ia=1;$ia<=25;$ia++) {
            $firstNameIndex = rand(0, count($firstNames) - 1);
            $lastNameIndex = rand(0, count($lastNames) - 1);
            $addressIndex = rand(0, count($addresses) - 1);
            $roleIndex = rand(0, count($roles) - 1);
            $userId = rand(100000, 999999);

            $photo = "https://picsum.photos/300/300?random=$userId";

            $followers = rand(1, 9999);
            $followings = rand(1, 9999);

            $postNumber = rand(1, 15);
            for ($i = 1; $i <= $postNumber; $i++) {
                $views = rand(100, 9999);
                $likes = rand(10, 999);
                $comments = rand(1, 99);
                $photo = "https://picsum.photos/300/300?random=$userId{$i}";
                $posts[$userId][] = [
                    'views' => $views,
                    'likes' => $likes,
                    'comments' => $comments,
                    'photo' => $photo,
                ];
            }

            $users[] = [
                "userId" => $userId,
                "name" => "{$firstNames[$firstNameIndex]} {$lastNames[$lastNameIndex]}",
                "info" => [
                    "address" => $addresses[$addressIndex],
                    "instagram" => "@" . strtolower($firstNames[$firstNameIndex]) . "." . strtolower($lastNames[$lastNameIndex]),
                    "facebook" => "{$firstNames[$firstNameIndex]} {$lastNames[$lastNameIndex]}",
                    "linkedin" => strtolower($firstNames[$firstNameIndex]) . "_" . strtolower($lastNames[$lastNameIndex]),
                    "gmail" => strtolower($firstNames[$firstNameIndex]) . "." . strtolower($lastNames[$lastNameIndex]) . "@gmail.com",
                ],
                "role" => $roles[$roleIndex],
                "photo" => $photo,
                "followers" => $followers,
                "followings" => $followings
            ];
        }

//dd($users);


        $data = "<?php\n\nreturn ".var_export($users,1).";";
        file_put_contents(config_path('users.php'),$data);

        $data = "<?php\n\nreturn ".var_export($posts,1).";";
        file_put_contents(config_path('posts.php'),$data);


        return response()->json($data,200,[],JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);

    }
}
