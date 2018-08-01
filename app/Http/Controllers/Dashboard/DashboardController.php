<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Requests\AvatarValidate;
use App\Http\Controllers\Controller;
use Caffeinated\Shinobi\Models\Role;
use Image;
use Storage;
use App\User;

class DashboardController extends Controller
{
    /**
     * index
     *
     * @return Dashboard home view  
     */
    
    public function index()
    {
        return view('home');
    }

    /**
     * show_perfil
     *
     * @return user data  
     * @param $user
     */
    public function profile($user)
    {
    	$profile_data = User::where('name', $user)->first();

    	return view('dashboard.profile.index', compact('profile_data'));
    }

    /**
     * edit
     *
     * @return user data  
     * @param $user
     */

    public function edit(User $id)
    {
        return view('dashboard.profile.edit', compact('id'));
    }

    /**
     * update
     *
     * @return user data  
     * @param $user
     */
    public function update(AvatarValidate $request, User $id)
    {
        $file = $request->file('avatar');

        $message = ['Datos actualizados correctamente', 'Ha ocurrido un error al validar, el avatar.'];

        if (is_null($file)) {
            $id->update(['name' => $request->name, 'email' => $request->email, 'phone' => $request->phone]);
            return redirect()->route('profile.index', username())->with('success', $message[0]);
        }

        if (!is_null($file)) {
           $img = Image::make($file->getRealPath())->resize(130, 130);

           $filename = str_random(20).'_'.md5($file->getClientOriginalName());

           $id->update(['avatar' => $filename]);

           Storage::disk('avatars')->put($filename, $img->encode());

           Storage::disk('avatars')->delete($request->old_avatar); 

           return redirect()->route('profile.index', username())->with('success', $message[0]);
        }
        
        return redirect()->route('profile.index', username())->with('error', $message[1]);
    }
}
