<?php if (validation_errors()) { ?>
<div class="nNote nWarning">
    <p><?php echo validation_errors(); ?></p>
</div>
<?php } ?>

<?php if ($this->session->flashdata('success_save')) { ?>
<div class="nNote nSuccess"><p><?php echo $this->session->flashdata('success_save'); ?></p></div>
<?php } ?>

<?php if ($this->session->flashdata('success_delete')) { ?>
<div class="nNote nSuccess"><p><?php echo $this->session->flashdata('success_delete'); ?></p></div>
<?php } ?>

<?php if ($this->session->flashdata('failure_delete')) { ?>
<div class="nNote nFailure"><p><?php echo $this->session->flashdata('failure_delete'); ?></p></div>
<?php } ?>

<?php if ($this->session->flashdata('custom_warning')) { ?>
<div class="nNote nWarning"><p><?php echo $this->session->flashdata('custom_warning'); ?></p></div>
<?php } ?>

<?php if ($this->session->flashdata('custom_error')) { ?>
<div class="nNote nFailure"><p><?php echo $this->session->flashdata('custom_error'); ?></p></div>
<?php } ?>

<?php if ($this->session->flashdata('custom_success')) { ?>
<div class="nNote nSuccess"><p><?php echo $this->session->flashdata('custom_success'); ?></p></div>
<?php } ?>

<?php if (isset($static_error) and $static_error) { ?>
<div class="nNote nFailure"><p><?php echo $static_error; ?></p></div>
<?php } ?>