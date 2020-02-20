<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constant extends Model {
	const USERPRIORITY = '0';
	const ADMINPRIORITY = '2';

	const TODOINITIATED = '1'; // état initial du Todo
	const TODOCOMPLETED = '2'; // todo terminé
	const TODOCANCELED = '3'; // todo

	const TTLTOKEN = 6000000; // Temps de vie du token
}
