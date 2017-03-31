<?php namespace Sirce\Http\Requests;

use Sirce\Http\Requests\Request;

class StoreComponentRequest extends Request {

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
			'component_category_id' => 'required',
			'component' => 'required',
			'manufacturer_id' => ''
		];
	}

}
