<?php $this->layout('layout') ?>

<div class="container">
	<?= $titulo_personal ?>
	estoy en la home de esta app
	<?php $this->insert('partials/banner', ['dato' => 'Esto se lo paso al bloque banner']) ?>
</div>