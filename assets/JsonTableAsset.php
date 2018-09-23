<?php

namespace app\assets;

class JsonTableAsset extends \yii\web\AssetBundle
{
    
   
    public $sourcePath = 'dynatable';
    
    public $css = [
        'jquery.dynatable.css'
    ];
    public $js = [
        'jquery.dynatable.js'
    ];
    public $depends =[
        'app\assets\DevAsset'
    ];
}

