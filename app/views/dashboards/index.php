<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row" id="content">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div id="wrapper">
                        <?php if(isAdminLoggedIn() === true){ ?>
                            <form action="<?php echo URLCURRENT; ?>" method="post">
                                <textarea class="tinymce" name="textarea_tinymce">

                                </textarea>
                                <input name="submitTinyMCEContent" type="submit" value="Save" class="btn btn-success btn-block">
                            </form>
                        <?php } ?>
                        <div id="tinymce_data">
                            <?php echo $data['textareaTinyMCE']; ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>