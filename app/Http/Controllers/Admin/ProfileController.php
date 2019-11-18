<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\ProfileHistory;
use Carbon\Carbon;

class ProfileController extends Controller
{
     public function add()
    {
        return view('admin.profile.create');
    }


    
    public function create(Request $request)
  {

      // 以下を追記
      // Varidationを行う
      $this->validate($request, Profile::$rules);

      $profile = new Profile;
      $form = $request->all();

        // dd($form['_token']);
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);

      // データベースに保存する
      $profile->fill($form);
      $profile->save();

      return redirect('admin/profile/create');
  }
  // 以下を追記
  public function index(Request $request)
  {
      $cond_name = $request->cond_name;
      if ($cond_name != '') {
          // 検索されたら検索結果を取得する
          $profiles = Profile::where('name', $cond_name)->get();
      } else {
      
          $profiles = Profile::all();
      }
      return view('admin.profile.index', ['profiles' => $profiles, 'cond_name' => $cond_name]);
  }

  public function edit(Request $request)
  {
      // Profile Modelからデータを取得する
      $profile = Profile::find($request->id);

      return view('admin.profile.edit', ['profile_form' => $profile]);
  }
  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Profile::$rules);
      // Profile Modelからデータを取得する
      $profile = Profile::find($request->id);
      // 送信されてきたフォームデータを格納する
      $profile_form = $request->all();
      unset($profile_form['_token']);

      // 該当するデータを上書きして保存する
      $profile->fill($profile_form)->save();
      // 以下を追記
        $history = new ProfileHistory;
        $history->profile_id = $profile->id;
        $history->edited_at = Carbon::now();
        $history->save();

      return redirect('admin/profile/edit?id=' . $profile->id);
      
  }
  
}
