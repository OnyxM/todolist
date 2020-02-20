<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model {
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'description', 'status', 'user_id',
	];


	/** The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'created_at', 'updated_at','user_id',
	];

	public function user() {
		return $this->belongsTo("App\User");
	}
}
