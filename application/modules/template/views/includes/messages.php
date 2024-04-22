<?php if ($this->session->flashdata('message')) { ?>
    <div id="success-alert" class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <?php echo $this->session->flashdata('message');
        $this->session->unset_userdata('message');
        ?>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('exception')) { ?>
    <div id="danger-alert" class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <?php echo $this->session->flashdata('exception');
        $this->session->unset_userdata('exception');
        ?>
    </div>
<?php } ?>
<?php if (validation_errors()) { ?>
    <div id="validation-alert" class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <?php echo validation_errors() ?>
    </div>
<?php } ?>
<script>
    // Function to remove alert after 3 seconds
    function removeAlert(alertId) {
        setTimeout(function () {
            var alert = document.getElementById(alertId);
            if (alert) {
                alert.remove();
            }
        }, 3000);
    }

    // Call removeAlert function for each alert
    removeAlert("success-alert");
    removeAlert("danger-alert");
    removeAlert("validation-alert");
</script>