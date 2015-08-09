<?php


use Illuminate\Support\Facades\Validator;

Validator::extend('youtube', function($attribute, $value, $parameters)
{
    //return true for now
    return true;
});