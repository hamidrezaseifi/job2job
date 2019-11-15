<?php
namespace frontend\modules;

class ControllerHelper
{
    public static function createHash($array) {
        $arraySerialized = serialize($array);
        $arrayHash = base64_encode($arraySerialized);
        return $arrayHash;
    }
    
    public static function readHash($arrayHash) {
        $arraySerialized = base64_decode($arrayHash);
        $array = unserialize($arraySerialized);
        return $array;
    }
    
    public static function readVerificationData($userType) {
        $array = ['userid' => 0, 'msg' => false];
        
        
        $a = isset($_GET['a']) ? $_GET['a'] : false;
        $b = isset($_GET['b']) ? $_GET['b'] : false;
        
        if(!$a || !$b)
        {
            $array['msg'] = 'ungültige verifikation link! : ERR-1';
            return $array;
        }
        
        $verifyDataB = ControllerHelper::readHash($b);
        $verifyDataA = ControllerHelper::readHash($a);
        
        
        if(!$verifyDataB || !$verifyDataA)
        {
            $array['msg'] = 'ungültige verifikation link! : ERR-2';
            return $array;
        }
        
        if(intval($verifyDataA['uid']) <= 0 || $verifyDataA['uid'] != $verifyDataB['uid'])
        {
            $array['msg'] = 'ungültige verifikation link! : ERR-3';
            return $array;
        }
        
        if(intval($verifyDataA['utp']) != $userType)
        {
            $array['msg'] = 'ungültige verifikation link! : ERR-4';
            return $array;
        }
        
        $verifyDataB['checkuca'] = strlen($verifyDataB['checkuca'] > 10) ? substr($verifyDataB['checkuca'], 0 , 10) : $verifyDataB['checkuca'];
        $date = date_create_from_format('Y-m-d', $verifyDataB['checkuca']);
        if(!$date)
        {
            $array['msg'] = 'ungültige verifikation link! : ERR-5';
            return $array;
            
        }
        $interval = date_diff($date, date_create());
        
        if(intval($interval->format('%a')) > 2) {
            $array['msg'] = 'ungültige verifikation link! : ERR-6';
            return $array;
        }
        
        $array['userid'] = intval($verifyDataA['uid']);
        
        return $array;
    }
}

