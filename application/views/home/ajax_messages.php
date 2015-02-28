<?php if ($type=='success') { ?>
<p class="notification"><?php echo $message; ?></p>
<?php } ?>

<?php if ($type=='delete') { ?>
<p class="notification"><?php echo $message;?></p>
</div>
<?php } ?>

<?php if ($type=='warning') { ?>
<p class="notification"><?php echo $message; ?></p>
<?php } ?>

<?php if ($type=='failure') { ?>
<p class="notification"><?php echo $message; ?></p>
<?php } ?>

<?php if ($type=='information') { ?>
<p class="notification"><?php echo $message; ?></p>
<?php } ?>