<?php namespace Sirce\Http\Requests;

use Sirce\Http\Requests\Request;

class StoreComponentCategoryRequest extends Request {

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
			'parent_id' => 'required',
			'category' => 'required'
		];
	}

}
