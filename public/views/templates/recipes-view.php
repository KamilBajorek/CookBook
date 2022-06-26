<section class="recipes">
    <?php foreach ($recipes as $recipe): ?>
        <div id="project-<?= $recipe->getId(); ?>" class="card">
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
                <?php if ($user->isAdmin()) { ?>
                    <a href="/delete/<?= $recipe->getId(); ?>"> <i class="fa-solid fa-trash"></i></a>
                <?php } ?>
            </div>
        </div>
    <?php endforeach; ?>
</section>