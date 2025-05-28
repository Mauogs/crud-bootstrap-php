</main>

<?php include COOKIE_TEMPLATE; ?>

<footer class="container text-center py-3 border-top">
    <p class="mb-0">&copy; 2024 - <?php echo date('Y'); ?> - João e Jean</p>
</footer>

<script src="<?php echo BASEURL; ?>js/jquery-3.7.1.min.js"></script>
<script src="<?php echo BASEURL; ?>js/awesome/all.min.js"></script>
<script src="<?php echo BASEURL; ?>js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASEURL; ?>js/main.js"></script>
<script src="<?php echo BASEURL; ?>js/jquery.mask.min.js"></script>
<script>
    var cookieModal = new bootstrap.Modal(document.getElementById('cookieModal'));
    cookieModal.show();
</script>

</body>

</html>