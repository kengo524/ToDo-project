<?php

namespace App\Http\Controllers;

use App\Models\Folder; //Folderモデルをインポート
use Illuminate\Http\Request;

use App\Http\Requests\CreateFolder; //validation適用のためRequestsで定義したCreateFolderをインポート

class FolderController extends Controller
{
    // フォルダ作成画面の表示
    public function showCreateForm()
    {
        return view('folders/create');
    }

    // フォルダ保存の関数
    public function create(CreateFolder $request) //validation適用のためRequestからCreateFolderに変更
    {
        // フォルダモデルのインスタンスを作成する
        $folder = new Folder();
        // タイトルに入力値を代入する
        $folder->title = $request->title;
        // インスタンスの状態をデータベースに書き込む
        $folder->save();

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}
