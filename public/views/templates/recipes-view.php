<section class="recipes">
    <?php foreach ($recipes as $recipe): ?>
        <div id="<?= $recipe->getId(); ?>" class="card">
            <a href="/recipe/<?= $recipe->getId(); ?>">
                <img src="public/uploads/<?= $recipe->getImage(); ?>">
            </a>
            <div>
                <div>
                    <h2 class="recipe-title"><?= $recipe->getTitle(); ?></h2>
                </div>
                <p><?= $recipe->getDescription(); ?></p>
                <div class="user-container">
                    <i class="fa-solid fa-user"></i>
                    <a><?= $recipe->getAuthor()->getName(); ?>
                        <?= $recipe->getAuthor()->getSurname(); ?></a>
                </div>
                <?php if (!$recipe->isSavedForUser()) { ?>
                <a class="save" href="#"> <i class="fas fa-save"></i></a>
                <?php } ?>

                <?php if ($recipe->isSavedForUser()) { ?>
                    <a class="unsave" href="#"> <i class="fa-solid fa-ban"></i></a>
                <?php } ?>

                <?php if ($user->isAdmin()) { ?>
                    <a href="#" class="delete" > <i class="fa-solid fa-trash"></i></a>
                <?php } ?>
            </div>
        </div>
    <?php endforeach; ?>
</section>

<?php $title = 'template'; include("recipe-template.php");?>
