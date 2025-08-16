<?php if (isset($_SESSION['exito'])): ?>
    <div class="mensaje exito">
        <?= $_SESSION['exito'] ?>
        <?php unset($_SESSION['exito']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="mensaje error">
        <?= $_SESSION['error'] ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>