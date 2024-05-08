<?php

namespace TriboonTAC\includes\admin\templates;

if(isset($_POST['tac-ram'])){
    $options = [
        'ram'=>$_POST['tac-ram']==='on'?true:false,
        'cpu'=>$_POST['tac-cpu']==='on'?true:false,
        'screen'=>$_POST['tac-screen']==='on'?true:false,
        'cart'=>$_POST['tac-cart']==='on'?true:false,
        'title'=>sanitize_text_field( $_POST['tac-title'] ),
        'img'=>sanitize_text_field( $_POST['tac-img'] ),
    ];
    update_option('tac_settings',$options );
}else{
    $options = get_option('tac_settings',false);
}
?>
<form method="POST" class="">
<table class="form-table">
    <tr>
        <th><label for="tac-ram">نمایش مقدار ram</label></th>
        <td>
            <input id="tac-ram" name="tac-ram" type="checkbox" class="regular-text" <?= checked($options['ram'],true) ?> />
        </td>
    </tr>
    <tr>
        <th><label for="tac-cpu">نمایش مقدار cpu</label></th>
        <td>
            <input id="tac-cpu" name="tac-cpu" type="checkbox" class="regular-text" <?= checked($options['cpu'],true) ?> />
        </td>
    </tr>
    <tr>
        <th><label for="tac-screen">نمایش مقدار screen</label></th>
        <td>
            <input id="tac-screen" name="tac-screen" type="checkbox" class="regular-text" <?= checked($options['screen'],true) ?> />
        </td>
    </tr>
    <tr>
        <th><label for="tac-cart">دکمه افزودن به سبد خرید</label></th>
        <td>
            <input id="tac-cart" name="tac-cart" type="checkbox" class="regular-text" <?= checked($options['cart'],true) ?> />
        </td>
    </tr>
    <tr>
        <th><label for="tac-title">عنوان صفحه مقایسه</label></th>
        <td>
            <input id="tac-title" name="tac-title" type="text" class="regular-text" value="<?= $options['title']?$options['title'] :''  ?>" />
        </td>
    </tr>
    <tr>
        <th>اندازه تصویر</th>
        <td>
            <div class="">
                <input id="tac-image-thumbnail" name="tac-img" type="radio" class="regular-text" value="thumbnail" <?= checked($options['img'],'thumbnail') ?> />
                <label for="tac-image-thumbnail">کوچک</label>
            </div>
            <div class="">
                <input id="tac-image-medium" name="tac-img" type="radio" class="regular-text" value="medium" <?= checked($options['img'],'medium') ?> />
                <label for="tac-image-medium">متوسط</label>
            </div>
            <div class="">
                <input id="tac-image-large" name="tac-img" type="radio" class="regular-text" value="large" <?= checked($options['img'],'large') ?>  />
                <label for="tac-image-large">بزرگ</label>
            </div>
        </td>
    </tr>
</table>
<button type="submit" class="button button-primary">ذخیره تغییرات</button>
</form>