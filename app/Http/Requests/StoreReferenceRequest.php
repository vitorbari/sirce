<?php namespace Sirce\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Sirce\Http\Requests\Request;
use Sirce\Models\Reference;

class StoreReferenceRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $reference = $this->route('sketches');

        if (!$reference) {
            return TRUE;
        }

        return Reference::where('id', $reference->id)
            ->where('user_id', Auth::id())->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'        => 'required|max:255',
            'component_id' => 'required',
            'language_id'  => 'required',
            'markdown'     => 'required'
        ];
    }

}
