<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div>
<?php

$str='<font size="2">ООО &laquo;Минимакс-Двина&raquo;</font>';

//$pattern='//i';
//preg_match_all($pattern,$str,$out);


$new_str=strip_tags($str);
echo strlen(trim($new_str));
?>
<h3><?= $new_str ?></h3>
$pr='[\s\w]*<td>(.*)';
