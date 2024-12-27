<?php

namespace App\Http\Requests\Public\Ticket;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $ticket_id = Ticket::orderBy('id', 'desc')->pluck('id')->first();

        if($ticket_id >= 1) {
            $this->merge([
                'ticket_id' => 'BZ-' . (5000 + $ticket_id),
            ]);
        } else {
            $this->merge([
                'ticket_id' => 'BZ-5000',
            ]);
        }

        $this->merge([
            'created_by' => User::getAuthUser()->id,
            'user_id'    => User::getAuthUser()->id,
        ]);
    }

    public function rules()
    {
        return [
            'ticket_id'  => ['required', 'string', 'max:255'],
            'subject'    => ['required', 'string', 'max:255'],
            'full_name'  => ['nullable', 'string', 'max:25'],
            'user_id'    => ['nullable', 'integer', 'max:25'],
            'priority'   => ['required', 'integer', 'max:25'],
            'message'    => ['required', 'string', 'max:555'],
            'attachment' => ['nullable','file', 'max:3000'],
            'created_by' => ['required', 'integer', 'max:25'],

        ];
    }
}
