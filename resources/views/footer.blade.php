<script>
    // Hover Shadow
    $(document).ready(function() {
        $(".card-hover").hover(
            function() {
                $(this).addClass('shadow-lg').css('cursor', 'pointer');
            },
            function() {
                $(this).removeClass('shadow-lg');
            }
        );
    });

    // Random Badge Color
    var warna = ['bg-primary', 'bg-secondary', 'bg-warning', 'bg-success', 'bg-danger'];
    $(document).ready(function() {
        $(".namaft").each(function() {
            var randomize = Math.floor(Math.random() * warna.length);
            $(this).addClass(warna[randomize]);
        });
    });

    // Select2
    $(document).ready(function() {
        $("#nama_ft").select2({

        });
    });

    // AOS
    // document.addEventListener("mousemove", e => {
    //     AOS.init();
    //     AOS.refresh();
    // });
    $(document).ready(function() {
        AOS.init();
    });
    
</script>