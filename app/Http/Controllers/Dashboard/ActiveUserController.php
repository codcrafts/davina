<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Client\ClientIndexResource;
use App\Http\Traits\ApiResponses;
use App\Models\User;
use Illuminate\Http\Request;

class ActiveUserController extends Controller
{
    use ApiResponses;

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->apiResponse(null, trans('app.exceptions.no_record_found'), 422);
        }
        $is_banned = $request->is_banned == 'false' ? true : false;

        $user->update(['is_banned' => $is_banned]);

        if ($user->is_banned == 0) {
            return  $this->apiResponse(null, trans('app.messages.active_user'), 200);
        } else {
            return  $this->apiResponse(null, trans('app.messages.in_active_user'), 200);
        }
    }

    public function activeUsers()
    {

        $users = User::whereType('client')->where('is_banned', 0)->orderBy('id', 'DESC')->get();
        return $this->apiResponse(ClientIndexResource::collection($users), '', 200);
    }
    public function inActiveUsers()
    {
        $users = User::whereType('client')->where('is_banned', 1)->orderBy('id', 'DESC')->get();
        return $this->apiResponse(ClientIndexResource::collection($users), '', 200);
    }
}
