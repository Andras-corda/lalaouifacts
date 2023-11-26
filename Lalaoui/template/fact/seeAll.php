<section>
    <div style="display: flex; flex-wrap: wrap;" class="justify-content-center">
        <?php foreach ($facts as $fact) : ?>
            <article>
                <h2><?= $fact->factContent ?></h2>
            </article>
        <?php endforeach; ?>
    </div>
</section>
