<?php

namespace Bookcrossing;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = ['from', 'to', 'book'];
}
