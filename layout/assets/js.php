
<script type="module" src="css/assets/js/hoisted-CGSqpsBX.js"></script>


<script src="js/jQuery_v3.1.1.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/bootsnav.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.magnific-popup.js"></script>
<script src="js/jquery.firstVisitPopup.js"></script>
<script src="js/custom.js"></script>
<script>

    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('هل أنت متأكد؟')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
    setTimeout(function () {
        $('.alert .close').click()

        var url = removeURLParameter(window.location.href, 'success')
        url = removeURLParameter(url, 'error')
        window.history.pushState('page2', 'Title', url);

    }, 5000)

    function removeURLParameter(url, parameter) {
        //prefer to use l.search if you have a location/link object
        var urlparts = url.split('?');
        if (urlparts.length >= 2) {

            var prefix = encodeURIComponent(parameter) + '=';
            var pars = urlparts[1].split(/[&;]/g);

            //reverse iteration as may be destructive
            for (var i = pars.length; i-- > 0;) {
                //idiom for string.startsWith
                if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                    pars.splice(i, 1);
                }
            }

            return urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : '');
        }
        return url;
    }

</script>


<?php
//if (session_status() != PHP_SESSION_ACTIVE) {
//    die('dd');
//    session_start();
//}
if (isset($_SESSION['loggedin']) && $_SESSION['type'] == 'designer') {

    ?>
    <script>
        Notification.requestPermission().then(function (permission) {
            console.log(permission)
        });

        $(document).ready(function () {
            setInterval(function () {
                $.get('checkOrders.php', function(data)
                {
                    if (data > 0)
                    {
                        var options = {
                            body: 'هناك طلب جديد',
                            data: {
                                time: new Date(Date.now()).toString(),
                                click_action: window.location.href
                            }

                        };
                        new Notification("LILIUM DESIGN", options)
                    }
                })
            },5000)
        })


    </script>

    <?php
}
?>