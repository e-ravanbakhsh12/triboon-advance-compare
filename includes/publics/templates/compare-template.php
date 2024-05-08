<?php
/*
 * Template Name: compare page
 * Template Post Type: page
 * @author Ehsan Ravanbakhsh
 */

$settingsOptions = get_option('tac_settings', false);
$product1 = wc_get_product(1213);
$product2 = wc_get_product(1207);
$image_size = $settingsOptions['img'];
$properties = [
    'ram' => 'مقدار حافظه',
    'cpu' => 'قدرت پردازنده',
    'screen' => 'ابعاد صفحه نمایش',
];
$currentPageUrl = get_permalink();
get_header();
?>
<div class="compare-container w-full py-10 px-4 md:px-0">
    <h2 class="w-full text-center mx-auto"><?= $settingsOptions['title'] ?></h2>
    <div class="grid grid-cols-2 bg-white">
        <div class="product-1 flex flex-col items-center border-l  border-b border-solid gap-5 border-neutral-300 p-5">
            <div class="w-fit">
                <?= get_the_post_thumbnail($product1->get_id(), $image_size); ?>
            </div>
            <a href="<?= get_the_permalink($product1->get_id()) ?>">
                <h2 class="title line-clamp-2 text-center text-lg">
                    <?= $product1->get_title() ?>
                </h2>
            </a>
            <div class="price"><?= wc_price($product2->get_price()) ?></div>
            <?php if ($settingsOptions['cart']) : ?>
                <a href="<?= $currentPageUrl ?>?add-to-cart=<?= $product1->get_id() ?>" class="bg-primary text-white flex-center h-10 px-4 rounded-xl hover:text-white">افزودن به سبد خرید</a>
            <?php endif ?>
        </div>
        <div class="product-1 flex flex-col items-center  border-b border-solid gap-5 border-neutral-300 p-5">
            <div class="w-fit">
                <?= get_the_post_thumbnail($product2->get_id(), $image_size); ?>
            </div>
            <a href="<?= get_the_permalink($product2->get_id()) ?>">
                <h2 class="title line-clamp-2 text-center text-lg">
                    <?= $product2->get_title() ?>
                </h2>
            </a>
            <div class="price"><?= wc_price($product2->get_price()) ?></div>
            <?php if ($settingsOptions['cart']) : ?>
                <a href="<?= $currentPageUrl ?>?add-to-cart=<?= $product2->get_id() ?>" class="bg-primary text-white flex-center h-10 px-4 rounded-xl hover:text-white">افزودن به سبد خرید</a>
            <?php endif ?>
        </div>

    </div>
    <div class="text-secondary font-bold text-xl my-4">مشخصات </div>
    <div class="flex flex-col w-full">
        <?php foreach ($properties as $key => $title) :
            if ($settingsOptions[$key]) :
        ?>
                <div class="flex flex-col border-b border-solid border-neutral-300">
                    <div class="pt-5 text-secondary text-lg tw-text-center md:text-right"><?= $title ?></div>
                    <div class="grid grid-cols-2 py-4">
                        <?php
                        $properties1 = get_post_meta($product1->get_id(), 'tac_' . $key, true);
                        $properties2 = get_post_meta($product2->get_id(), 'tac_' . $key, true);
                        ?>
                        <div class="p-2 tw-text-center md:text-right"><?= $properties1 ?></div>
                        <div class="p-2 tw-text-center md:text-right border-r border-solid border-neutral-300"><?= $properties2 ?></div>
                    </div>
                </div>
        <?php
            endif;
        endforeach ?>
    </div>
</div>


<?php get_footer() ?>