<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserMembershipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // there is a name in the form but i dont want to update it
            'membership_plan_id' => 'sometimes|required|exists:membership_plans,id',
            'expired_at' => 'sometimes|required|date',
            'amount' => 'sometimes|required|numeric|min:0',
            'payment_method' => 'sometimes|required|string|max:255',
            'user_id' => [
            'sometimes',
            'required',
            'exists:users,id',
            Rule::unique('user_memberships')
                ->ignore($this->route('userMemberships'))
                ->where(fn($query) => $query->where('is_active', true)),
        ],
        ];
    }
}
