<?php
// All Vars For Automation
/*
BODY = [.:BODY:.]
*/
?>
<?php require APPROOT . '/views/inc/header.php'; ?>
<style>
    #body {
      width: 100%;
      height: 100%;
      border: 1px solid #aaaaaa;
    }
</style>
<div id="body" ondrop="drop(event)" ondragover="allowDrop(event)">
    <?php // [.:BODY:.] ?>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>