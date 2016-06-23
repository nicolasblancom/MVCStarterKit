<?php $this->layout('layout') ?>

<div class="container">
   
    <?php if($pregunta): ?>
        <article class="pregunta">
            <h3><?= $pregunta->asunto ?></h3>
            <p><?= $pregunta->cuerpo ?></p>
            <p id="cuantasresp">Respuestas <span id="numrespuestas"><?= $cuantas ?></span></p>

            <p><a href="/preguntas/getJSONrespuestas/<?= $pregunta->id_pregunta ?>" id="veryaenviadas">Ver respuestas ya enviadas</a></p>

        </article>
        <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="post" id="formulariorespuestaJSON">
            <p>
                <label for="respuesta">Respuesta</label>
                <span><textarea name="respuesta"></textarea></span>
            </p>
            <p><input type="submit" value="Enviar"></p>
        </form>  
        <div class="mensajef"></div>
        <div id="respuestasjson"></div>
        <?php else: ?>
            <p>Pregunta no encontrada</p>
        <?php endif ?>  
</div>

<script type="text/x-handlebars-template" src="/js/template-respuestas.js" id="template">
</script> 

<script type="text/x-handlebars-template" id="template2">
<h3>Respuestas</h3>
<select>
{{# each respuestas}}
<option>
    Respuesta: {{respuesta}} 
    - id: {{id_respuesta}}
</option>
{{/each}}
</select>
</script> 