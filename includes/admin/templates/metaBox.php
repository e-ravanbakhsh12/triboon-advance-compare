<?php

$ram = get_post_meta($post->ID, 'tac_ram', true);
$cpu = get_post_meta($post->ID, 'tac_cpu', true);
$screen = get_post_meta($post->ID, 'tac_screen', true);
$properties = [
    'ram' => !empty($ram) ? $ram : '',
    'cpu' => !empty($cpu) ? $cpu : '',
    'screen' => !empty($screen) ? $screen : '',
];
?>
<table class="form-table">
    <?php foreach ($properties as $item => $value) : ?>
        <tr>
            <th><label for="tac_<?= $item ?>"><?= $item ?></label></th>
            <td>
                <input id="tac_<?= $item ?>" name="tac_<?= $item ?>" type="text" class="regular-text" value="<?= $value  ?>" />
            </td>
        </tr>
    <?php endforeach ?>

</table>