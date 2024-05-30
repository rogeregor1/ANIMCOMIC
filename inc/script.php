<script>
    document.addEventListener('DOMContentLoaded', () => {

        // traer "navbar-burger" elements
        const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

        // Validar barraBurger si existe
        if ($navbarBurgers.length > 0) {

            // agregar un elemento por cada click evento
            $navbarBurgers.forEach( el => {
                el.addEventListener('click', () => {

                // Get the target from the "data-target" attribute
                const target = el.dataset.target;
                const $target = document.getElementById(target);

                // Toggle activar y desactivar barraBurger "navbar-menu"
                el.classList.toggle('is-active');
                $target.classList.toggle('is-active');

                });
            });
        }
    });
</script>
<script src="js/ajax.js"></script>