<?php $this->layout('layout') ?>

<div class="container">
   
   <?php $this->insert('partials/feedback') ?>

    <h2>Todas las preguntas</h2>
    <?php if(count($preguntas)==0): ?>
        <p>No se encuentran preguntas en la base de datos</p>
    <?php else: ?>
        <p>Tenemos <?= count($preguntas) ?> encontradas:</p>
        <?php foreach ($preguntas as $pregunta): ?>
            <article class="pregunta">
                <h3><?= $pregunta->asunto ?></h3>
                <p><?= $pregunta->cuerpo ?></p>
                <footer>
                    <a href="/preguntas/editar/<?= $pregunta->slug ?>">[ Editar ]</a>
                </footer>
            </article>
        <?php endforeach ?>
    <?php endif ?>
    
</div>