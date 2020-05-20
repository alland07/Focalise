<?php get_header() ?>

<form class="form-inline">
    <input type="search" name="s" class="form-control mb-2 mr-sm-2" value="<?= get_search_query() ?>" placeholder="Votre recherche">

    <div class="form-check mb-2 mr-sm-2">
        <input class="form-check-input" type="checkbox" value="1" name="sponso" id="inlineFormCheck" <?= checked('1', get_query_var('sponso'))  ?>>
        <label class="form-check-label" for="inlineFormCheck">
            Article sponsorisé seulement
        </label>
    </div>

    <button type="submit" class="btn btn-primary mb-2">Rechercher</button>
</form>

<h1 class="mb-4"> <?= sprintf(apply_filters('montheme_search_title', "Résultat pour votre recherche \"%s\""), get_search_query()) ?></h1>
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