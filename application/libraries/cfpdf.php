<?php if ( !defined('BASEPATH')) exit();
class Cfpdf
{
    function __construct()
    {
        require_once APPPATH.'/libraries/fpdf/fpdf.php';
    }
}