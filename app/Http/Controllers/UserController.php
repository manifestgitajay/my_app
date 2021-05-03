<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Model\Role;
use DB;


class UserController extends Controller
{

public function index(){
  

    $user=get_user(1);
    echo '<pre>';print_r($user);


//    DB::table('users')->orderBy('id')->chunk(3, function ($users) {
//      echo '<pre>'; print_r($users);
//     return false;
//         foreach ($users as $user) {
            
//       }
//     });

// DB::table('users')->lazy()->each(function ($user) {
//     //
// });
// if (DB::table('users')->where('name', 'Retta Rat')->doesntExist()) {
//           echo 'aja';
// }
// $users=DB::table('users')->groupby('name')->get(['name']);
// $users = DB::table('users')->distinct()->get();

// echo '<pre>';print_r($users);


// $users = DB::table('users')
//             //  ->select(DB::raw('count("name") as user_count, name'))
//              ->selectRaw('count("name") as user_count, name', ['email'])
//              ->where('name', '<>', 'Cornelius Witting')
//              ->groupBy('name')
//              ->get();

//              echo '<pre>';print_r($users);
}


}
