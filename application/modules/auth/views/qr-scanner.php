<video id="preview"></video>
<script type="text/javascript">
    let scanner
    = new Instascan.Scanner({video: document.getElementById('preview'), backgroundScan: false});
    scanner.addListener('scan', function (content) {
	//alert(content);
        $.ajax({
	   url: baseurl+'auth/ajax_login',
	   data: {key:content},
	   cache: false,
	   type: 'POST',
	   success: function(res)
	   {
	       $res = JSON.parse(res);
	       if ( $res.status == 'success' )
	       {
		   $.toast({
                        heading: 'Login successful',
                        text: '',
                        position: 'top-right',
                        loaderBg: '#fff',
                        icon: 'success',
                        hideAfter: 3500,
                        stack: 6
                    });
		   location.href = baseurl+'dashboard';
	       }else{
		   $.toast({
                        heading: 'Login failed',
                        text: 'Invalid Qr code or login key',
                        position: 'top-right',
                        loaderBg: '#fff',
                        icon: 'error',
                        hideAfter: 3500,
                        stack: 6
                    });
		    $('#modal_ajax').on('hide.bs.modal', function(){
			scanner.stop();
		    });
	       }
	   }
	});
	return false;
    });
    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function (e) {
        console.error(e);
    });

    $('#modal_ajax').on('hide.bs.modal', function () {
	scanner.stop();
    });
</script>