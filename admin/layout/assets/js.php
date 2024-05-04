
<script src="assets/dashboard/js/jquery.js"></script>
<!-- bootstrap -->
<script src="assets/dashboard/js/bootstrap.min.js"></script>
<!-- apper  -->
<script src="assets/dashboard/js/jquery.appear.js"></script>
<!-- select -->
<script src="assets/dashboard/js/select2.min.js"></script>
<!-- animation on scroll -->
<script src="assets/dashboard/js/aos.js"></script>
<!-- odometer counterUp  -->
<script src="assets/dashboard/js/odometer.min.js"></script>
<!-- custom -->
<script src="assets/dashboard/js/Custom.js"></script>
<script src="assets/dashboard/js/jquery.fancybox.min.js"></script>






<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="assets/dashboard/js/pages/sweetalerts.init.js"></script>
<script src="assets/dashboard/libs/apexcharts/apexcharts.min.js"></script>

<script>
    $('.lds-hourglass').fadeOut(1000)
    $(document).on('keyup','.numbersOnly',function () {
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });
    setTimeout(function (){
        $('.alert .close').click()

        var url =removeURLParameter(window.location.href,'success')
        url =removeURLParameter(url,'error')
        window.history.pushState('page2', 'Title', url);

    },5000)
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
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are You Sure?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>