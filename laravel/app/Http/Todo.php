<?php

namespace App\Http;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    //モデルの属性（カラム）のうち、保護されるべきであるとマークされた属性を指定します。
    //['id']と指定されているため、id属性はマスアサインメント（Mass Assignment）によって一括で変更されるのを防ぎます。
    protected $table = 'todo';
    //モデルが対応するデータベースのテーブル名を指定しています。todoと指定されているため、Todoモデルはtodoテーブルと対応します。
    public static $rules = [
        'title' => 'required',
        'content' => 'required',
    ];
    //Todoモデルに対して適用されるバリデーションルールを定義しています。title属性とcontent属性は必須項目であることを示しています。
    //これにより、titleとcontentの値が空である場合はバリデーションエラーが発生します。

    public function scopeFlg ($query, $num) {
        return $query->where ('flg', $num);
    }
    //Todoモデルのクエリスコープを定義しています。クエリスコープは、よく使われるクエリ条件を再利用可能な方法で定義するための便利な手法です。
    //scopeFlgというスコープは、引数$numを受け取り、flg属性の値が$numと一致するレコードのみを取得するクエリを返します。
}
