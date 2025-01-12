<?php
use Morilog\Jalali\Jalalian;

function toJalali($date, $format = 'Y/m/d')
{
    return Jalalian::fromDateTime($date)->format($format);
}
