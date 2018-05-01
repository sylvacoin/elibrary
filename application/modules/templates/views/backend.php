<?php require('assets/header.php'); ?>

<?php 
if ( is_numeric($this->session->user_id) ) {
    require('assets/backend-topnavbar.php'); 
}
?>
<?php require('assets/backend-sidemenu.php'); ?>
<?php require('assets/main.php'); ?>
<?php require('assets/footer.php'); ?>
<!--/.row -->

            