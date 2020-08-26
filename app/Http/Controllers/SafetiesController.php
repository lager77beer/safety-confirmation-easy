<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disaster;    // 追加
use App\Safety;      // 追加
use App\Safety_user;      // 追加
use App\User;      // 追加

class SafetiesController extends Controller
{
    /**
     * ユーザー安否確認一覧 index
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByDisaster($disaster_id)
    {
        //災害idで抽出したdisasterを$disasterにセット
        $disaster = Disaster::find($disaster_id);
        //災害idで抽出したSafety_userを$Safety_userにセット
        $safety_users = Safety_user::where('disaster_id', $disaster_id)->orderBy('updated_at', 'desc')->get();//ページネーションpaginate(10)はやめる
        
        //ログインユーザー
        $user = \Auth::user();
        //ユーザーが管理者の場合
        $admin = null;
        if($user->admin == '9'){
            $admin = "admin";
        }

        $data = [
            'disaster' => $disaster,
            'safety_users' => $safety_users,
            'admin' => $admin,
        ];

        //安否一覧へ
        return view('safeties.indexByDisaster',$data);
    }

    /**
     * ユーザー安否登録・変更 edit
     *
     * @return \Illuminate\Http\Response
     */
    public function editByUser($id)
    {
        //ログインユーザー
        $user = \Auth::user();
        $disaster = [];

        //ユーザーが管理者の場合は選択されたユーザーのsafety
        if($user->admin == '9'){
            $safety_user =  Safety_user::find($id);
            $user = User::find($safety_user->user_id);
            $disaster = Disaster::find($safety_user->disaster_id);
            $safety = $safety_user->safety();
        //ユーザーが一般の場合はログインユーザーのsafety
        }else{
            //ユーザーが一般の場合はログインユーザーのsafety
            //直近のsafety１つを$safetyにセット
            $safety = $user->latestSafety();
            //safetyに登録されたdisaster
            if($safety != null){
                $disaster = $safety->disaster();
            }
        }

        $data = [
            'user' => $user,
            'safety' => $safety,
            'disaster' => $disaster,
        ];
        
        return view('safeties.editByUser', $data);
    }

    /**
     * ユーザー安否登録・変更 Update
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'contact_information' => 'nullable|max:180',
        ]);

        $update = [
            'myself' => $request->myself,
            'contact_information' => $request->contact_information,
        ];
        Safety::where('id', $id)->update($update);

        return back()->with('message', '更新しました。');
    }

}
