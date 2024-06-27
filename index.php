<?php  include 'config.php'; ?>
<?php  include 'header.php'; ?>
<?php 
echo '<pre>';
print_r($menu);
echo '</pre>';
?>
<script>
$(document).ready(function() {
	$('.menu-link').menuFullpage();
} );
</script>


<?php  include 'footer.php';

/*
 *
 *
 *
 * www.Luzinelab.com
 * Abdessamad ELMAZGHY
 *
 *
 *
 *
 *
 * */

?>
