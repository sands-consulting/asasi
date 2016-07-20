<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Venturecraft\Revisionable\RevisionableTrait;

class Model extends Eloquent
{
	use RevisionableTrait;
}