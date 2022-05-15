<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFolder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // false→trueに変更
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    //requiredによるエラーメッセージの表示
    //上記に加え、DBで設定した文字数制限を別途Requestsで上限文字数を追加
    public function rules()
    {
        return [
            'title' => 'required|max:20',
        ];
    }

    //上記エラー発生時にtitleを日本語表示「フォルダ名」に変更するためのメソッド
    public function attributes()
    {
        return [
            'title' => 'フォルダ名',
        ];
    }

}
