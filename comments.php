<?php

use MonTheme\CommentWalker;

$count = absint(get_comments_number());
?>

<?php if ($count > 0) : ?>
    <h2><?= sprintf(_n('%s Commentaire', '%s Commentaires', $count, 'montheme'), $count); ?></h2>
<h2><?= $count ?> Commentaire <?= $count > 1 ? 's' : '' ?></h2>
<?php else: ?>
<h2>Laisser un commentaire</h2>
<?php endif ?>
<?php if (comments_open()): ?>
<?php comment_form(['title_reply' => '']) ?>
<?php endif ?>

<?php wp_list_comments(['style' => 'div', 'walker' => new CommentWalker()]) ?>

<?php paginate_comments_links() ?>