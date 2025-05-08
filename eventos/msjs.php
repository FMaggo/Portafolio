<?php if(isset($_REQUEST['e'])): ?>
<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
  El evento fue registrado correctamente.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif; ?>

<?php if(isset($_REQUEST['ea'])): ?>
<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
  El evento fue actualizado correctamente.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif; ?>

<?php if(isset($_REQUEST['e']) || isset($_REQUEST['ea'])): ?>
<script>
    setTimeout(function() {
        $(".alert").slideUp(300);
    }, 3000);
</script>
<?php endif; ?>
