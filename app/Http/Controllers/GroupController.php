<?php

namespace App\Http\Controllers;

use App\Events\DeleteUser;
use App\Events\SendEmail;
use App\Events\UpdateUser;
use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class GroupController extends Controller
{
    public function addUser($user_id, $group_id)
    {
        $user = User::find($user_id);
        $group = Group::find($group_id);

        $dt = Carbon::now();
        $dt->addHours($group->expire_hours);

        try {
            $newRow = DB::table('group_user')
                ->insert([
                    'group_id' => $group->id,
                    'user_id' => $user->id,
                    'expired_at' => $dt
                ]);
            if($newRow === true && !$user->active){
                $user->active = true;
                $user->save();
            }

            echo "Пользователь $user->name добавлен в группу - $group->name";
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function checkExpiration()
    {
        $dt = Carbon::now();

        $rows = DB::table('group_user')->select('user_id', 'group_id', 'expired_at')->get();

        foreach ($rows as $row) {
            if ($row->expired_at < $dt) {
                try {
                    DB::table('group_user')->where('user_id', '=', $row->user_id)->delete();
                    $user = User::find($row->user_id);
                    $group = Group::find($row->group_id);
                    event(new SendEmail($user, $group));
                } catch (Exception $exception) {
                    echo $exception->getMessage();
                }
            }
        }
    }
}
