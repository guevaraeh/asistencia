<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if (!Gate::allows('manage-assistance'))
            abort(403);

        return view('user.index',['users' => User::get()]);
    }

    public function edit(User $user)
    {
        if (!Gate::allows('manage-assistance'))
            abort(403);

        return view('user.edit',['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        if (!Gate::allows('manage-assistance'))
            abort(403);

        $user->username = $request->input('username');
        $user->name = $request->input('name');
        //$user->lastname = $request->input('lastname');
        $user->email = $request->input('email');

        $user->save();

        return redirect(route('user'))->with('success', 'Usuario editado');
    }

    public function update_password(Request $request, User $user)
    {
        if (!Gate::allows('manage-assistance'))
            abort(403);

        if($request->input('password') == $request->input('repeat_password'))
        {
            $user->password = Hash::make($request->input('password'));
            $user->save();
        }
        else 
            return back()->with('error', 'Fallo en cambiar contraseña');

        return redirect(route('user'))->with('success', 'Contraseña editada');
    }

    public function reset_password(User $user)
    {
        if (!Gate::allows('manage-assistance'))
            abort(403);

        $password = Str::random(10);
        $user->password = Hash::make($password);
        $user->save();

        $message = 
        '<b>Contraseña cambiada.</b>
        <br><b>Usuario:     </b>'.$user->username.'
        <br><b>Contraseña:  </b>'.$password;

        return redirect(route('user'))->with('changed', $message);
    }
}
