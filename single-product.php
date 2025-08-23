
<?php get_header(); ?>
</br>
</br>

    <!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script></head>
<body class="bg-gray-50 p-6 font-sans">
    <?php
    $terms = wp_get_post_terms(get_the_ID(), 'product_category');
    if (!empty($terms)) {
      $related = new WP_Query([
        'post_type' => 'product',
        'posts_per_page' => 3,
        'post__not_in' => [get_the_ID()],
        'tax_query' => [
          [
            'taxonomy' => 'product_category',
            'field' => 'term_id',
            'terms' => wp_list_pluck($terms, 'term_id'),
          ]
        ]
      ]);
      if ($related->have_posts()) {
        echo '<ul class="space-y-3 text-gray-600">';
        while ($related->have_posts()) {
          $related->the_post();
          echo '<li class="flex items-center">';
          if (has_post_thumbnail()) {
            the_post_thumbnail('thumbnail', ['class' => 'w-10 h-auto mx-2 hover:underline']);
          }
          echo '<p>' . get_the_title() . '</p></li><hr>';
        }
        echo '</ul>';
        wp_reset_postdata();
      }
    }
    ?>

   <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-5 ">
    <div class="bg-white p-6 shadow rounded-lg h-80 ">
      <h2 class="text-lg  text-gray-800 mb-4 ">محصولات مشابه</h2>
      <ul class="space-y-3 text-gray-600 ">
        <li class="flex items-center"><img class="w-10 h-auto " src="<?php echo get_template_directory_uri();?>/camera1.jpg"><p>دوربین دیجیتال آکسونAX6062</p></li>
        <hr>
        <li class="flex items-center"><img class="w-10 h-auto " src="<?php echo get_template_directory_uri();?>/camera2.jpg"><p>دوربین دیجیتال آکسون مدلAX6062</p></li>
        <hr>
        <li class="flex items-center"><img class="w-10 h-auto " src="<?php echo get_template_directory_uri();?>/camera1.jpg"><p>دوربین دیجیتال آکسونAX6062</p></li>
      </ul>
    </div>

    <div class="md:col-span-3 bg-white p-6 rounded-lg shadow">
        <?php if (has_post_thumbnail()) {
          the_post_thumbnail('medium', ['class' => 'w-80 h-auto mx-55']);
        } ?>
        <div class="flex justify-between items-center gap-4">
      <h2 class="text-xl">دوربین دیجیتال canon EOS250D</h2>
      <?php
        $price = get_post_meta(get_the_ID(), 'price', true);
        $oldPrice = get_post_meta(get_the_ID(), 'old_price', true);
        $discount = 0;
          if ($oldPrice && $price) {
            $discount = round((($oldPrice - $price) / $oldPrice) * 100);
                                    }
                                        ?>
                                        
            <div class="bg-red-500 text-sm text-white w-13 h-5 rounded text-center">
              <?= $discount ?>%
            </div>
               <span class="line-through text-gray-400 text-sm">
                  <?= number_format($oldPrice) ?> تومان
                </span>
             <span class="text-sm text-gray-700 font-bold">
                  <?= number_format($price) ?> تومان
              </span>
        </div>
                                  </br>
             <div class="flex gap-2 mt-2 mb-0">

              <p class="text-gray-700 mb-4">
                <?php the_content(); ?>
              </p>


    </div>
                                  </br>
      <button class="flex-1 bg-blue-500 text-white w-35 h-10 rounded-lg hover:bg-blue-900 transition ">افزودن
        به سبد</button>
                                  </br>
      <h2 class="text-lg font-bold text-gray-800 mb-2">ویژگی‌ها:</h2>
      <ul class="list-disc pr-5 text-gray-700 space-y-1">
        <li>نوع حسگر: CMOS</li>
        <li>قطع حسگر: APS-C / Crop Frame (نیم‌فریم)</li>
      </ul>
            </div>

  </div>
                                  </br>
</body>
<?php get_footer(); ?>
</html>
