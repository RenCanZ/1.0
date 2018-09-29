<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{	
	protected $fillable = ['name', 'pass', 'phone'];

    protected $table = 'member';

    public $timestamps = false;
}
