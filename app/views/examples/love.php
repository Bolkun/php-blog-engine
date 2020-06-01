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
<div id="body" ondrop='drop(event, <?php echo jsonEncode(); ?>)' ondragover="allowDrop(event)">
    <div id="body_reload">
        <h1><?php echo $data['title']; ?></h1>
        <?php // [.:BODY:.] ?>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>