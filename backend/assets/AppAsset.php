<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/custom.css',
        'extension/jQuery-Validation-Engine-master/css/validationEngine.jquery.css',
        'extension/jquery-ui-1.11.4.custom/jquery-ui.css',
        'extension/jquery-ui-1.11.4.custom/jquery-ui-smoothness.css',
    ];
    public $js = [
        'extension/jQuery-Validation-Engine-master/js/jquery.validationEngine.js',
        'extension/jQuery-Validation-Engine-master/js/languages/jquery.validationEngine-vi.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',

    ];
}
