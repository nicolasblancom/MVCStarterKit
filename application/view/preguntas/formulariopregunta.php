<div class="container">
    
    <?php if (isset($this->accion) && $this->accion == "editar"): ?>
        <h2>Editar una pregunta</h2>
    <?php else: ?>
        <h2>¿Qué quieres saber?</h2>
        <p>Dinos cuál es tu pregunta. Al preguntar intenta ser claro y plantear tu duda de manera que pueda servir también de utilidad para otras personas.</p>
    <?php endif ?>

	<?php $this->renderFeedbackMessages() ?>

    <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="post">
        <?php if (isset($this->accion) && $this->accion == "editar"): ?>
            <input type="hidden" name="id_pregunta" value="<?= $this->datos['id_pregunta'] ?>">
        <?php endif ?>
        <p>
            <label for="asunto">Asunto</label>
            <span><input type="text" name="asunto" value="<?= (isset($this->datos['asunto'])) ? $this->datos['asunto'] : "" ?>"></span>
        </p>
        <p>
            <label for="cuerpo">Cuerpo</label>
            <span><textarea name="cuerpo"><?= (isset($this->datos['cuerpo'])) ? $this->datos['cuerpo'] : "" ?></textarea></span>
        </p>
        <p><input type="submit" value="Enviar"></p>
    </form>

</div>