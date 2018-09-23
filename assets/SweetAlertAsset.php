<?php

namespace app\assets;

class SweetAlertAsset extends \yii\web\AssetBundle
{
    
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
    public $sourcePath = 'swal';
    public $css = [
        'sweetalert.css',
    ];
    public $js = [
        'sweetalert.min.js'
    ];
}

