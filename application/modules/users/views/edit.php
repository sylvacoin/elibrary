<div class="w3-section">
    <div class="w3-col s12 w3-container">
	<div class="w3-card-2 w3-row w3-white">
	    <div class="w3-container w3-border-bottom w3-border-light-grey">
		<h3><?= $page_title ?></h3>
	    </div>
	    <div class="w3-content" style="width: 50%; min-width: 280px; box-sizing: border-box;">
		<form class="w3-container" method="post" enctype="multipart/form-data">
		    <?php
		    if ($this->session->flashdata('error') != NULL) {
			echo DIV_ERR . $this->session->flashdata('error') . DIV_CLOSE;
		    }

		    if ($this->session->flashdata('success') != NULL) {
			echo DIV_SUCCESS . $this->session->flashdata('success') . DIV_CLOSE;
		    }
		    ?>
		    <?= validation_errors(DIV_ERR, DIV_CLOSE) ?>
		    <div class="w3-section">
			<label class="w3-label w3-text-grey"><b>First name</b></label>
			<input class="w3-input w3-border" type="text" name="fname" value="<?= isset($fname) ? $fname : set_value('fname') ?>">
		    </div>
		    <div class="w3-section">
			<label class="w3-label w3-text-grey"><b>Last name</b></label>
			<input class="w3-input w3-border" type="text" name="lname" value="<?= isset($lname) ? $lname : set_value('lname') ?>">
		    </div>
		    <div class="w3-section">
			<label class="w3-label w3-text-grey"><b>User name</b></label>
			<input class="w3-input w3-border" type="text" name="uname" value="<?= isset($uname) ? $uname : set_value('uname') ?>">
		    </div>
		    <div class="w3-section">
			<label class="w3-label w3-text-grey"><b>Email Address</b></label>
			<input class="w3-input w3-border" type="email" name="email" value="<?= isset($email) ? $email : set_value('email') ?>">
		    </div>
		    <div class="w3-section">
			<label class="w3-label w3-text-grey"><b>Phone number</b></label>
			<input class="w3-input w3-border" type="text" name="phone" value="<?= isset($phone) ? $phone : set_value('phone') ?>">
		    </div>
		    <div class="w3-section">
			<div  style="margin:0px auto;">
			<img src="<?= isset($photo) && $photo != NULL ? base_url($photo) : base_url('assets/img/static/avatar2.png') ?>" width="150px" height="150px" class="w3-left w3-circle w3-margin" id="preview" onClick="browse(); return false;" style="cursor: pointer"/>
			</div>
			<div class="w3-right w3-col l6">
			    <p class="w3-center">click on image to change profile</p>
			    <input id="file" class="w3-input" type="file" name="photo" value="<?= isset($phone) ? $phone : set_value('phone') ?>" style="display:none;">
			</div>

			<div class="clearfix"></div>
		    </div>
		    <div class="w3-section">
			<input class="w3-btn w3-green w3-mobile" type="submit" value="Update Profile" />
		    </div>

		</form>
	    </div>
	</div>
    </div>
</div>
<script>
    document.getElementById("file").onchange = function () {

        var reader = new FileReader();
        reader.onload = function (e) {
            var error = '', width, height;

            var img = document.getElementById("file");
            var max_size = '1000';
            var max_width = '600';
            var max_height = '600';

            if (img.files && img.files[0]) {


                var imgobj = new Image();
                imgobj.src = window.URL.createObjectURL(img.files[0]);
                imgobj.onload = function ()
                {
                    width = imgobj.naturalWidth;
                    height = imgobj.naturalHeight;
                    var size = Math.floor(img.files[0].size / 1024);

                    if (size > max_size)
                    {
                        error = 'maximum image size exceeded.';
                    }

                    if (width > max_width || height > max_height)
                    {
                        alert('Maximum width or height exceeded for image.');
                        return false;
                    }

                    if (error.length == 0)
                    {
                        document.getElementById("preview").src = e.target.result;
                    } else {
                        alert(error);
                    }
                    window.URL.revokeObjectURL(imgobj.src);
                }

            }
        };

        reader.readAsDataURL(this.files[0]);
	return false;
    };
</script>