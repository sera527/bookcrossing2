<?php

namespace Bookcrossing;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'author', 'lang', 'year', 'photo', 'user', 'taken', 'current_owner', 'description'];
}
