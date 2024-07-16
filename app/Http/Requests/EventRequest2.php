<?php 
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest2 extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date_time' => 'required',
            'location' => 'required|string',
            'category_id' => 'required',
            'available_seats' => 'required|integer',
            'user_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'price' => 'required|integer',
        ];
    }
}
