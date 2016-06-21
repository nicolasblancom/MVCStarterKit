<?php if(!is_null(Session::get("feedback_negative")) && count(Session::get("feedback_negative")) > 0): ?>
    <div class="errorf">
        <ul>
            <?php foreach(Session::get("feedback_negative") as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>

<?php if(!is_null(Session::get("feedback_positive")) && count(Session::get("feedback_positive")) > 0): ?>
    <div class="exitof">
        <ul>
            <?php foreach(Session::get("feedback_positive") as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>

<?php $this->borrar_msg_feedback(); ?>