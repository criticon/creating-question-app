<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Question;

class QuestionStoreRequest extends FormRequest
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
            'text' => ['required', function ($attribute, $value, $fail) {
                // Determine how many questions current user has created during the last day
                $iQuestionCounter = Question::where(
                    [['user_id', Auth::user()->id],
                    ['created_at', '>=', \Carbon\Carbon::now()->subDay()]]
                )->count();

                // Fail if the user has added more than one question during the last day
                if ($iQuestionCounter >= 1) {
                    $fail('Too many questions. You are allowed to add one question a day');
                }
            }],
            'country' => 'required|exists:countries,name|in:Emirates',
            'email' => 'required|exists:users,email'
        ];
    }
}
