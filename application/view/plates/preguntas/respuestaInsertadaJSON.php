<?php if($respuesta): ?>
	<?php 
		$res = array(
			'exito' => true,
			//'msg' => '<span class="exitof">Respuesta insertada correctamente</span>'
			'msg' => 'Respuesta insertada correctamente',
			//'cuantas' => PreguntasModel::cuantasRespuestasIDResp($respuesta),
			'cuantas' => $cuantas
		);
	?>
<?php else: ?>
	<?php 
		$res = array(
			'exito' => false,
			'msg' => $this->fetch('partials/feedback')
		);
	?>
<?php endif ?>
<?= json_encode($res) ?>