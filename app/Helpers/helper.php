<?php 


use App\Models\User;

if (!function_exists('get_user')) {
    function get_user($id)
    {
        $res = User::where(["users.id" => $id])
            ->first();
        return $res;
    }
}


?>