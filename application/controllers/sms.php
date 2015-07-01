<?php
class sms extends CI_Controller
{
    var $folder =   "dosen";
    var $tables =   "app_dosen";
    var $pk     =   "dosen_id";
    
    function __construct() {
        parent::__construct();
        $this->_kirim_sms('082121473036', 'testting kirim sms');
    }
    
    function index()
    {
        $pesan="232323";
        //echo strlen($pesan);
    }
    
    
    function _kirim_sms($noHp,$pesan)
    {
        // jika jumlah pesan 153 pakai metode outbox
        //selsain itu ke mode multipart
        $pesan  =   str_replace("'", "/", $pesan);
        $jmlSms = ceil(strlen($pesan)/153);
        if($jmlSms==1)
        {
            // kirim ke outbox
            $data   =   array(  'DestinationNumber'=>$noHp,
                            'TextDecoded'=>$pesan,
                            'SenderID'=>'testSms',
                            'CreatorID'=>'Nuris');
            $this->db->insert('outbox',$data);
        }
    }
    
    function kirim_sms($noHp,$pesan,$modem)
    {
        $pesan  =   str_replace("'", "/", $pesan);
        // menghitung jumlah sms
        $jmlSms = ceil(strlen($pesan)/153);
        if(strlen($pesan)>153)
        {
             // pecah sms menjadi beberapa bagian
            $pecah  =  str_split($pesan,153);
            // baca id terakhir dari table outbox
            $j      =  $this->db->query("show table status like 'outbox'")->row_array();
            $newID  =   $j['Auto_increment'];
            $random =   rand(1, 255);
            $headUDH= sprintf("%02s",  strtoupper(dechex($random)));
            for($i=1;$i<=$jmlSms;$i++)
            {
                $udh    =   "050003".$headUDH.sprintf("%02s",$jmlSms).sprintf("%02s",$i);
                $msg    =   $pecah[$i-1];
                if($i==1)
                {
                    $this->kirim_biasa($noHp, $msg);
                }
                else
                {
                    
                }
            }
            
        }

        $modem  =   "testingSMS";
        $data   =   array(  'DestinationNumber'=>$noHp,
                            'TextDecoded'=>$pesan,
                            'SenderID'=>$modem,
                            'CreatorID'=>'Nuris');
         $this->db->insert('outbox',$data);
    }
    
    function kirim_biasa($noHp,$pesan)
    {
        $pesan  =   str_replace("'", "/", $pesan);
        $modem  =   "testingSMS";
        $data   =   array(  'DestinationNumber'=>$noHp,
                            'TextDecoded'=>$pesan,
                            'SenderID'=>$modem,
                            'CreatorID'=>'Nuris');
         $this->db->insert('outbox',$data);
    }
}