<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disaster;    // 追加
use App\User;        // 追加
use App\Safety;      // 追加


class DisastersController extends Controller
{
    /**
     * 災害一覧 index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ログインユーザー
        $user = \Auth::user();

        //ログイン状態の場合
        if (\Auth::check()) {
            //ユーザーが管理者の場合
            if($user->admin == '9'){
                //災害一覧を$disastersにセット
                $disasters = Disaster::orderBy('created_at', 'desc')->get();//ページネーションpaginate(10)はやめる
                //災害一覧へ
                return view('disasters.index', ['disasters' => $disasters,]);
            //ユーザーが一般の場合
            }else{
                //安否確認へリダイレクト
                return redirect(route('safety.editByUser', ['id' => $user->id]));
            }
        //ログアウト状態の場合
        }else{
            //ログインへリダイレクト
            return redirect('login');
        }
    }

    /**
     * 災害登録確認
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:20',
        ]);
        
        // 全ユーザー（管理者以外）の安否をcreateする対象userのidとemalを抽出する。
        $allUsers = User::all(); 
        $users = [];
        foreach ($allUsers as $key => $user) {
            if($user->admin != "9"){
                $users[$key] = $user;
            }
        }

        $disaster = ['name' => $request->name,];

        //登録確認画面へ
        return view('disasters.create', ['users' => $users,'disaster' => $disaster,]);
    }

    /**
     * 災害登録
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:20',
        ]);

        $disaster = new Disaster();
        $disaster->name = $request->name;
        $disaster->save(); // saveをすると
        /* 'id'を取得するためにsave()にした。
        Disaster::create([
            'name' => $request->name,
        ]);
        $disaster->id = (new UserIdSequenceService())->getNewId(); // 'id'を取得
        */
        
        // 全ユーザー（管理者以外）の安否をcreateする。
        $allUsers = User::all(); 
        $user_mails = [];
        foreach ($allUsers as $key => $user) {
            if($user->admin != "9"){
                // 既に登録済みかの確認
                $exist = $disaster->has_safety($user->id);
                if (!$exist) {
                    // 未登録であれば登録する
                    Safety::create([
                        'disaster_id' => $disaster->id,
                        'user_id' => $user->id,
                        'myself' => "不明",
                        'contact_information' => null,
                    ]);
                    //emailを$mailsにセット
                    $mails = $user->email;
                }
            }
        }

        //災害一覧へリダイレクト（[]：パラメータなし）
        return redirect(route('disasters.index', []));
    }

    /**
     * 災害メンテ edit
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $disaster = Disaster::find($id);
        return view('disasters.edit',  ['disaster' => $disaster,]);
    }

    /**
     * 災害メンテ update
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:20',
        ]);

        $update = [
            'name' => $request->name,
        ];
        Disaster::where('id', $id)->update($update);

        return back()->with('message', '更新しました。');
    }

    /**
     * 災害メンテ destroy
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $disaster = Disaster::find($id);
        $disaster->delete();

        //ルートへリダイレクト
        return redirect('/');
    }
}
