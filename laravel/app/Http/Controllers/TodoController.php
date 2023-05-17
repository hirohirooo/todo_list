<?php

namespace App\Http\Controllers;

use App\Http\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index () {
        $runningItems = Todo::flg (1)->get ();
        $doneItems = Todo::flg (0)->get ();
        return view ('todo', [
            'runningItems' => $runningItems,
            'doneItems' => $doneItems,
        ]);
    }
    //このメソッドは、/todoへのGETリクエストに対する処理を定義しています。
    //Todoモデルのflg属性が1のアイテム（$runningItems）と0のアイテム（$doneItems）を取得し、それらをビューに渡しています。

    public function create (Request $request) {
        $this->validate ($request, todo::$rules);
        $todo = new Todo;
        //新しいTodoモデルのインスタンスを作成します。これにより、新しいTodoレコード（データベースの行）が作成される準備が整います。
        $form = $request->all ();
        unset ($form['_token']);
        //_tokenというキーを持つデータを削除します。
        //通常、_tokenはクロスサイトリクエストフォージェリ（CSRF）トークンであり、データベースに保存する必要はありません。
        $form['flg'] = 1;
        //$form配列にflgキーを追加し、その値を1に設定します。
        $todo->fill ($form)->save ();
        //モデルの属性に対して一括で値を設定するために使用されます。$formのデータは$todoモデルの属性に対応するように自動的にマッピングされます。
        //そして、save()メソッドを呼び出してデータベースに新しいTodoレコードを保存します。
        return redirect ('/todo');
    }

    public function update (Request $request) {
        $todo = Todo::find ($request->id);
        $todo->flg = 0;
        $todo->save ();
        return redirect ('/todo');
    }

    public function delete (Request $request) {
        $todo = Todo::find ($request->id);
        $todo->delete ();
        return redirect ('/todo');
    }
}
