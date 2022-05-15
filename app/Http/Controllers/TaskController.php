<?php

namespace App\Http\Controllers;

use App\Models\Folder; //Folderモデルをインポート
use App\Models\Task; //Taskモデルをインポート
use App\Http\Requests\CreateTask; //validation適用のためRequestsで定義したCreateFolderをインポート
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

    /**
     * GET /folders/{id}/tasks/create
     */
    //タスクの作成画面の表示
    public function showCreateForm(int $id)
    {
        //タスク作成にあたりURLでフォルダIDが必要のため、
        //コントローラーメソッドの引数で受け取ってviewで渡す。
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }

    //タスク保存
    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        //$current_folder に紐づくタスクを作成。
        $current_folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }
}
