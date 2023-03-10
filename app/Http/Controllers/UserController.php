<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserReQuest;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct(User $user)
    {
        $this->model = (new User())->query();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('userpage.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('userpage.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        if ($request->get('password') !== $request->get('cfpass')) {
            return redirect()->route('userpage.register')->withErrors('Xác nhận lại mật khẩu không đúng!!');
        } else {
            $this->model->create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'gender' => $request->get('gender'),
                'birthdate' => $request->get('birthdate'),
                'password' => Hash::make($request->get('password'))
            ]);

            return redirect()->route('userpage.login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::query()->where('user_id', $id)->firstOrFail();
        $gender = ['1' => 'Nam', '0' => 'Nữ'];
        return view('userpage.profile', ['user' => $user, 'gender' => $gender]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $path = public_path('assets/images/users/');
        if ($request->file('avatar') !== null) {
            if (!File::exists($path)) {
                // Tạo folder
                File::makeDirectory($path . 'user' . $id, 0777, true, true);
            } else {
                // Delete old avatar
                File::delete($path . $request->get('old-avatar'));
            }

            $avatar = $request->file('avatar');
            $avatar_name = 'user' . $id . '/' . time() . $avatar->getClientOriginalName();
            $avatar->move($path . 'user' . $id, $avatar_name);

            $this->model->where('user_id', $id)->update([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'gender' => $request->get('gender'),
                'avatar' => $avatar_name,
                'phone_number' => $request->get('phone_number'),
            ]);
        } else {
            $this->model->where('user_id', $id)->update([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'gender' => $request->get('gender'),
                'phone_number' => $request->get('phone_number'),
            ]);
        }

        return redirect()->route('userpage.profile', ['user_id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
