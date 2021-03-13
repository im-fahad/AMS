<?php

namespace App\Http\Controllers\Api;

use App\Enum\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Image;

class UserController extends Controller
{
    public static $messageService = MessageService::class;

    public function update(UserUpdateRequest $request)
    {
        $data = $request->except(['avatar']);

        $user = User::find(auth()->user()->id);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $file_name = auth()->user()->username . uniqid('_avatar_') . '.' . $avatar->getClientOriginalExtension();
            $destination_path = public_path('images/users/' . $file_name);

            if (File::exists('images/users/' . $user->avatar)) {
                File::delete('images/users/' . $user->avatar);
            }

            Image::make($avatar)->resize(300, 200)->save($destination_path);
            $user->update(['avatar' => $file_name]);
        }

        $user->update($data);

        return response()->json([
            'status' => 200,
            'message' => 'Successfully User Data Updated'
        ]);
    }

    public function delete(User $user)
    {
        if ((auth()->user()->id !== $user->id) && ((auth()->user()->role == Role::SUPER_ADMIN) || (auth()->user()->role == Role::ADMIN))) {
            $user->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Successfully User Delete'
            ]);

        }

        return response()->json([
            'status' => 500,
            'message' => 'Unauthorized'
        ]);
    }
}
