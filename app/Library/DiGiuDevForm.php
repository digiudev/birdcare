<?php

namespace App\Library;

class DiGiuDevForm
{
    public static function onofswitch($name = 'onoffswitch', $value = true, $lbl = null, $id = null)
    {
        if($lbl===null) $lbl = ucfirst($name);
        if($id===null) $id=$name;
        $html = '<div class="content-onoffswitch"><div class="onoffswitch">';

        $html.='<input type="checkbox" name="'.$name.'" class="onoffswitch-checkbox" id="'.$id.'"';
        if($value) $html.='checked';
        $html.='>';
        $html.='<label class="onoffswitch-label" for="'.$id.'">
            <span class="onoffswitch-inner"></span>
            <span class="onoffswitch-switch"></span>
        </label>';
        $html.='</div>';
        $html.='<div style="float:right">
            <label style="padding:10px;">'.$lbl.'</label>
        </div>';
        $html.='<div style="clear:both;"></div>';
        $html.='</div>';

        echo $html;
    }

    public static function getValSwitch($name){
        if(empty($_POST[$name]))
            return 0;
        if($_POST[$name]=='on')
            return 1;
        return 0;
    }
}