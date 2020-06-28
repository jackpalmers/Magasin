<?php


function dateFormat($string)
{
    $date = date('Y-m-d', strtotime($string));

    return $date;
}