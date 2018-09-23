<?php

namespace app\assets;

class JsonTableAsset extends \yii\web\AssetBundle
{
    
   
    public $sourcePath = 'js';
    
    public $js = [
        'JSON-to-Table.min.1.0.0.js'
    ];
    public $depends =[
        'app\assets\DevAsset'
    ];
}

