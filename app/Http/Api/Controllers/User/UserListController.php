<?php

namespace App\Http\Api\Controllers\User;

use App\Http\Api\Controllers\ApiController;
use App\Http\Api\Requests\User\UserListRequest;
use App\Http\Api\Resources\UserListResource;
use App\Models\User;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;

class UserListController extends ApiController
{

    public function __invoke(UserListRequest $request)
    {
        $request->validated();

        $page = (int)$request->page;
        $count = (int)$request->count;
        $offset = (int)$request->offset ?? 0;


        $total = DB::table('users')->count();

        $skip = max($offset + ($page - 1) * $count, 0);

        $users = User::query()
            ->orderByDesc('created_at')
            ->skip($skip)
            ->limit($count)
            ->with('position')
            ->get();

        $paginator = new LengthAwarePaginator($users, $total, $count, LengthAwarePaginator::resolveCurrentPage(), [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        $paginator->appends(['count' => $request->count]);

        return UserListResource::make($paginator);

    }
}
