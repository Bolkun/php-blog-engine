<?php
// All Vars For Automation
/*
BODY = [.:BODY:.]
*/
?>
<?php require APPROOT . '/views/inc/header.php'; ?>
<style>
    #body {
        margin 0;
        border: 5px dashed orange;
        background-color: #1c7430;
    }
    .container_text {
        color: orange;
        text-align: center;
    }
</style>
<div id="body" ondrop='drop(event, <?php echo jsonEncode(); ?>)' ondragover="allowDrop(event)">
    <div id="body_reload">
        <?php // body starts ?>
        <h1 class="container_text"><?php echo "Add container"; ?></h1>
        <?php // body ends ?>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>