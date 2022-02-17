{{-- chatango --}}
<div class="">
    <script id="cid0020000271796876883" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js"
            style="width: 247px;height: 362px;">
        {
            "handle": "neonovel",
            "arch": "js",
            "styles": {
                "a": "383838",
                "b": 100,
                "c": "FFFFFF",
                "d": "FFFFFF",
                "k": "383838",
                "l": "383838",
                "m": "383838",
                "n": "FFFFFF",
                "p": "10",
                "q": "383838",
                "r": 100,
                "pos": "br",
                "cv": 1,
                "cvbg": "202020",
                "cvw": 370,
                "cvh": 41,
                "surl": 0,
                "cnrs": "0.35",
                "ticker": 1
            }
        }
    </script>
</div>

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