<div class="row">
    <div class="col-md-4 col-xs-12">
	<div class="white-box">
	    <div class="user-bg"> <img width="100%" alt="user" src="<?= base_url() ?>assets/images/large/img1.jpg">
		<div class="overlay-box">
		    <div class="user-content">
			<a href="javascript:void(0)"><img src="<?= base_url() ?>assets/images/users/varun.jpg" class="thumb-lg img-circle" alt="img"></a>
			<h4 class="text-white"><?= $user->firstname ?> <?= $user->lastname ?></h4>
			<h5 class="text-white"><?= $user->email ?></h5> </div>
		</div>
	    </div>
	    <div class="user-btm-box">
		<p class="text-center"><i class="fa fa-exclamation-circle"></i>use qrcode to login </p>
	    </div>
	    <div class="user-qr-box" id="qrcode">
		
	    </div>
	</div>
    </div>
    <div class="col-md-8 col-xs-12">
	<div class="white-box">
	    <form class="form-horizontal form-material">
		<div class="form-group">
		    <label class="col-md-12">Full Name</label>
		    <div class="col-md-12">
			<input readonly="readonly" type="text" placeholder="Johnathan Doe" class="form-control form-control-line" value="<?= $user->firstname ?> <?= $user->lastname ?>"> </div>
		</div>
		<div class="form-group">
		    <label for="example-email" class="col-md-12">Email</label>
		    <div class="col-md-12">
			<input readonly="readonly" type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email"value="<?= $user->email ?>"> </div>
		</div>
		<div class="form-group">
		    <label class="col-md-12">Username</label>
		    <div class="col-md-12">
			<input readonly="readonly" type="text" class="form-control form-control-line" value="<?= $user->username ?>"> </div>
		</div>
		<div class="form-group">
		    <label class="col-md-12">Phone No</label>
		    <div class="col-md-12">
			<input readonly="readonly" type="text" placeholder="123 456 7890" class="form-control form-control-line" value="<?= $user->phone ?>"> </div>
		</div>
	    </form>
	</div>
    </div>
</div>
<!-- /.row -->



<script>
    var options = {
        // render method: 'canvas', 'image' or 'div'
        render: 'image',
        // version range somewhere in 1 .. 40
        minVersion: 1,
        maxVersion: 40,
        // error correction level: 'L', 'M', 'Q' or 'H'
        ecLevel: 'L',
        // offset in pixel if drawn onto existing canvas
        left: 0,
        top: 0,
        // size in pixel
        size: 282,
        // code color or image element
        fill: '#000',
        // background color or image element, null for transparent background
        background: null,
        // content
        text: '<?= $user->email ?>',
        // corner radius relative to module width: 0.0 .. 0.5
        radius: 0,
        // quiet zone in modules
        quiet: 0,
        // modes
        // 0: normal
        // 1: label strip
        // 2: label box
        // 3: image strip
        // 4: image box
        mode: 0,
        mSize: 0.1,
        mPosX: 0.5,
        mPosY: 0.5,
        label: '<?= $user->pword ?>',
        fontname: 'sans',
        fontcolor: '#000',
        image: null
    }
    $('#qrcode').qrcode(options);
</script>