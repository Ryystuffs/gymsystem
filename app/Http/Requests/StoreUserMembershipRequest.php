<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreUserMembershipRequest extends FormRequest
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
            'user_id' => [
            'required',
            'exists:users,id',
            Rule::unique('user_memberships')->where(function ($query) {
                $query->where('is_active', true);
            }),
        ],
            'membership_plan_id' => 'required|exists:membership_plans,id',
            'expired_at' => 'required|date',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
        ];
    }
}
