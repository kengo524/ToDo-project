<?php

namespace App\Http\Controllers;

use App\Models\Folder; //Folderモデルをインポート
use App\Models\Task; //Taskモデルをインポート
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(int $id){
        // すべてのフォルダを取得する
        $folders = Folder::all();

        // 選ばれたフォルダを取得する
        $current_folder = Folder::find($id);

        // 選ばれたフォルダに紐づくタスクを取得する
        //親のFolderモデルにhasManyメソッドを記載することで下記のように修正可能
        //$tasks = Task::where('folder_id', $current_folder->id)->get();
        $tasks = $current_folder->tasks()->get();

        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $id,
            'tasks' => $tasks,
        ]);
    }
}
