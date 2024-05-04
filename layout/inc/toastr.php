<link rel="stylesheet" type="text/css" href="assets/toastr/toastr.min.css">
<script type="text/javascript" src="assets/toastr/toastr.min.js"></script>

<script>

    function my_toaster(message = 'تم بنجاح ',type = 'success'){
        var color1 =  '#80c204';
        var color2 =  '#a0ff00';
        if (type == 'error'){
            color1 =  '#c20505';
            color2 =  '#ff0000';
        }
        else if (type == 'info'){
            color1 =  '#0522bf';
            color2 =  '#002aff';
        }
        else if (type == 'warning'){
            color1 =  '#c4a90a';
            color2 =  '#fce303';
        }

        Toastify({
            text: message,
            duration: 3000,
            // destination: "https://github.com/apvarun/toastify-js",
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, "+color1+", "+color2+")",
            },
            onClick: function(){} // Callback after click
        }).showToast();
    }
    // my_toaster() //Calling

</script>

<?php
if (isset($_GET['success'])){
    echo "<script>my_toaster('{$_GET['success']}','success')</script>";
}
if (isset($_GET['error'])){
    echo "<script>my_toaster('{$_GET['error']}','error')</script>";
}
?>

<script>
    setTimeout(function (){
        var url = window.location.href;
        url = removeURLParameter(url,'success')
        url = removeURLParameter(url,'error')
        history.pushState(null, null, url);
    },3000)

    function removeURLParameter(url, parameter) {
        var urlParts = url.split('?');
        if (urlParts.length >= 2) {
            var prefix = encodeURIComponent(parameter) + '=';
            var parts = urlParts[1].split(/[&;]/g);

            // Loop through the parts of the query string and remove the parameter if found
            for (var i = parts.length; i-- > 0;) {
                if (parts[i].lastIndexOf(prefix, 0) !== -1) {
                    parts.splice(i, 1);
                }
            }

            // Reconstruct the URL
            url = urlParts[0] + (parts.length > 0 ? '?' + parts.join('&') : '');
        }
        return url;
    }

</script>
