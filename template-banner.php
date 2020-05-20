<?php 
/**
 * Template Name: Page avec bannière
 * Template Post Type: page, post
 */
?>

<?php get_header() ?>

<?php $sports = get_terms(['taxonomy' => 'sport']); ?>
<ul class='nav nav-pills my-4'>
    <?php foreach ($sports as $sport) : ?>
        <li class="nav-item">
            <a href="<?= get_term_link($sport) ?>" class="nav-link <?= is_tax('sport', $sport->term_id) ? 'active' : '' ?>"> <?= $sport->name ?></a>
        </li>
    <?php endforeach; ?>
</ul>


<?php if (have_posts()) : ?>
    <div class="row">

        <?php while (have_posts()) : the_post(); ?>
            <div class="col-sm-4">
                <?php get_template_part('parts/post', 'post'); ?>
            </div>
        <?php endwhile ?>
    </div>
    <?php montheme_pagination() ?>
    <!-- <?= paginate_links(); ?> -->


<?php else : ?>
    <h1>Pas d'articles</h1>
<?php endif; ?>

<?php get_footer() ?>