<?php

if(!function_exists('str_camel')){
    function str_camel($str){
        return lcfirst(str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $str))));
    }
}