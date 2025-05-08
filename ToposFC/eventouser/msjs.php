
<?php
if(isset($_REQUEST['e'])){ ?>
<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
  <strong>Felicitaciones!</strong> El evento fue solicitado correctamente.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php } ?>

<?php
if(isset($_REQUEST['ea'])){ ?>
<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
  <strong>Felicitaciones!</strong> El evento se revisará para eliminar.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php } ?>
