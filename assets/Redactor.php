<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 13.08.15
 * Time: 14:03
 */

namespace app\assets;

use dosamigos\ckeditor\CKEditor;
use iutbay\yii2kcfinder\KCFinder;
use iutbay\yii2kcfinder\KCFinderAsset;
use yii\helpers\ArrayHelper;

class Redactor extends CKEditor{

    public $userOptions = [];

    public function init()
    {
        $theme = new AppAsset();
        $baseUrl = \Yii::getAlias($theme->baseUrl);
        $cssList = [];
        foreach ($theme->css as $css) {

            if(preg_match('#^http#',$css))
                continue;

            $cssList[] = $baseUrl . '/' . $css;
        }

        $this->clientOptions = [
            'toolbar' => 'full',
            'contentsCss' => $cssList,
            'allowedContent' => true,
            'disallowedContent' => 'img{width,height,style}',
            'extraAllowedContent' => 'div(*){*}[*],span(*){*}[*]',
            'enterMode' => 2,
            'shiftEnterMode' => 1,
            'image2_disableResizer' => true,
            'image2_prefillDimensions' => false,
        ];

        if($this->userOptions)
        {
            foreach($this->userOptions as $k=>$v)
            {
                $this->clientOptions[$k] = $v;
            }
        }

        parent::init();
    }

    public function run()
    {

//        echo '<div class="tinymce-editor" style="z-index:9999;position: relative">';
          parent::run();
//        echo '</div>';
    }

    public $enableKCFinder = true;

    /**
     * Registers CKEditor plugin
     */
    protected function registerPlugin()
    {
        if ($this->enableKCFinder) {
            $this->registerKCFinder();
        }

        parent::registerPlugin();
    }

    /**
     * Registers KCFinder
     */
    protected function registerKCFinder()
    {
        $register = KCFinderAsset::register($this->view);
        $kcfinderUrl = $register->baseUrl;

        $browseOptions = [
            'filebrowserImageBrowseUrl' => $kcfinderUrl . '/browse.php?opener=ckeditor&type=files',
            'filebrowserImageUploadUrl' => $kcfinderUrl . '/upload.php?opener=ckeditor&type=files',
        ];

        $this->clientOptions = ArrayHelper::merge($browseOptions, $this->clientOptions);
    }

}// kcfinder options
// http://kcfinder.sunhater.com/install#dynamic
$kcfOptions = array_merge(KCFinder::$kcfDefaultOptions, [
    'dirPerms' => 0777,
    'filePerms' => 0777,
    'uploadDir' => realpath($_SERVER['DOCUMENT_ROOT'].'/uploads/'.THEME),
    'uploadURL' => \Yii::getAlias('@web') . '/uploads/'.THEME,
    'types'=>[
        'files' => "",
        'flash' => "swf",
        'images' => "*img",
    ],
    'access' => [
        'files' => [
            'upload' => true,
            'delete' => true,
            'copy' => false,
            'move' => false,
            'rename' => false,
        ],
        'dirs' => [
            'create' => true,
            'delete' => true,
            'rename' => false,
        ],
    ],
]);
\file_put_contents('log.txt',print_r($kcfOptions,1));
// Set kcfinder session options
\Yii::$app->session->set('KCFINDER', $kcfOptions);