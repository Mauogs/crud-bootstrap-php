</main>

<footer class="container text-center py-3 border-top">
    <p class="mb-0">&copy; 2024 - <?php echo date('Y'); ?> - João e Jean</p>
</footer>

<?php include COOKIE_TEMPLATE; ?>

<script src="<?php echo BASEURL; ?>js/jquery-3.7.1.min.js"></script>
<script src="<?php echo BASEURL; ?>js/awesome/all.min.js"></script>
<script src="<?php echo BASEURL; ?>js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASEURL; ?>js/main.js"></script>
<script src="<?php echo BASEURL; ?>js/jquery.mask.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.1/cookieconsent.min.js"></script>

<script>
    window.addEventListener("load", function () {
        window.cookieconsent.initialise({
            palette: {
                popup: { background: "#000" },
                button: { background: "#ccc", text: "#000" }
            },
            theme: "classic",
            position: "top-right",
            content: {
                message: "Usamos cookies para melhorar sua experiência.",
                dismiss: "Aceitar",
                deny: "Recusar",
                link: "Detalhes",
                href: "#"
            },
            onInitialise: function (status) {
                console.log("Cookie consent status:", status);
            },
            onStatusChange: function (status) {
                console.log("Cookie status mudou para:", status);
            }
        });
    });

    document.addEventListener("click", function (event) {
        if (event.target && event.target.classList.contains("cc-link")) {
            event.preventDefault();
            abrirDetalhes();
        }
    });

    function abrirDetalhes() {
        document.getElementById('cookie-details-modal').style.display = 'block';
    }

    function fecharDetalhes() {
        document.getElementById('cookie-details-modal').style.display = 'none';
    }
</script>

</body>

</html>