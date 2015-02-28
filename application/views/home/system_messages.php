<?php if (validation_errors()) { ?>
<div class="nNote nValidation">
    <p><?php echo validation_errors(); ?></p>
</div>
<?php } ?>

<?php if ($this->session->flashdata('success_save')) { ?><br />
<p class="notification"><?php echo $this->session->flashdata('success_save'); ?></p>
<?php } ?>

<?php if ($this->session->flashdata('success_delete')) { ?><br />
<p class="notification"><?php echo $this->session->flashdata('success_delete'); ?></p>
<?php } ?>

<?php if ($this->session->flashdata('failure_delete')) { ?><br />
<div class="nNote nFailure"><p><?php echo $this->session->flashdata('failure_delete'); ?></p></div>
<?php } ?>

<?php if ($this->session->flashdata('custom_warning')) { ?><br />
<div class="nNote nWarning"><p><?php echo $this->session->flashdata('custom_warning'); ?></p></div>
<?php } ?>

<?php if ($this->session->flashdata('custom_error')) { ?><br />
<div class="nNote nFailure"><p><?php echo $this->session->flashdata('custom_error'); ?></p></div>
<?php } ?>

<?php if ($this->session->flashdata('custom_success')) { ?><br />
<div class="nNote nSuccess"><p><?php echo $this->session->flashdata('custom_success'); ?></p></div>
<?php } ?>

<?php if (isset($static_error) and $static_error) { ?><br />
<div class="nNote nFailure"><p><?php echo $static_error; ?></p></div>
<?php } ?>