<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;        // 追加

use Illuminate\Support\Facades\Log;


class UsersController extends Controller
{

    /**
     * ユーザー情報更新 edit
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //ログインユーザー
        $user = \Auth::user();
        //ユーザーが管理者の場合
        if($user->admin == '9'){
            $user = User::find($id);
        }

        return view('users.edit',  ['user' => $user,]);
    }

    /**
     * ユーザー情報更新 update
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|max:20',
        ]);

        $update = [
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
        ];
        User::where('id', $id)->update($update);

        return back()->with('message', '更新しました。');
    }

    /**
     * ユーザー情報更新 destroy
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        //ルートへリダイレクト
        return redirect('/');
    }
}
