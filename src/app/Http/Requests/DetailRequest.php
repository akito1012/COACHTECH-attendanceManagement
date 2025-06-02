<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'clock_in' => ['date_format:H:i', 'before:clock_out'],
            'clock_out' => [' date_format:H:i', 'after:clock_in'],
            'break_in' => ['date_format:H:i', 'after:clock_in', 'before:clock_out'],
            'break_out' => ['date_format:H:i', 'after:break_in', 'before:clock_out'],
            'remark' => 'required'
        ];
    }
    public function messages()
    {
        return[
            'clock_in.date_format' => '入力は時間形式（００：００）で入力してください',
            'clock_in.before' => '出勤時間もしくは退勤時間が不適切な値です',
            'clock_out.date_format' => '入力は時間形式（００：００）で入力してください',
            'clock_out.after' => '出勤時間もしくは退勤時間が不適切な値です',
            'break_in.date_format' => '入力は時間形式（００：００）で入力してください',
            'break_in.after' => '休憩時間が勤務時間外です',
            'break_in.before' => '休憩時間が勤務時間外です',
            'break_out.date_format' => '入力は時間形式（００：００）で入力してください',
            'break_out.after' => '休憩時間が勤務時間外です',
            'break_out.before' => '休憩時間が勤務時間外です',
            'remark.required' => '備考を記入してください',
        ];
    }
}
