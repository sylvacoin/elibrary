<div class="w3-container w3-section w3-card-2 w3-border-0 w3-white">
    <div class="w3-container w3-border-bottom w3-border-light-grey">
	<h3><?= $page_title ?></h3>
    </div>
    <div class="w3-col m12 s12">
	<div class="w3-content">
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
		<div class="w3-col m7 l7 s12 w3-mobile w3-container">
		    <div class="w3-section w3-container w3-pale-blue">
			<p>This region allows you to enter details of your business </p>
		    </div>

		    <div class="w3-section">
			<input class="w3-input w3-border" type="text" name="bname" value="<?= isset($bname) ? $bname : set_value('bname') ?>" placeholder="Business name">
		    </div>

		    <div class="w3-section">
			<label class="w3-label w3-text-grey"><b>Business type.</b></label>
			<?php
			$data = ['' => '--choose--', 0 => 'Individual ( not registered )',
			    1 => 'Corporate ( registered )'];
			?>
			<?= form_dropdown('btype', $data, (isset($btype) ? $btype : set_value('btype')), 'class="w3-select w3-border"') ?>
		    </div>

		    <div class="w3-section">
			<input class="w3-input w3-border" type="email" name="email" value="<?= isset($email) ? $email : set_value('email') ?>" placeholder="Company / Business email address">
		    </div>
		    <div class="w3-section">
			<input class="w3-input w3-border" type="text" name="phone" value="<?= isset($phone) ? $phone : set_value('phone') ?>" placeholder="Company / Business contact numbers (e.g 090781234,1234561)">
		    </div>
		    <div class="w3-section">
			<input class="w3-input w3-border" type="text" name="website" value="<?= isset($website) ? $website : set_value('website') ?>" placeholder="Company / business website url (optional)">
		    </div>
		    <div class="w3-section">
			<textarea class="w3-input w3-border" type="text" name="description" placeholder="Business description of services"><?= isset($description) ? $description : set_value('description') ?></textarea>
		    </div>
		</div>
		<div class="w3-col m5 l5 s12 w3-mobile w3-container">

		    <div class="w3-section">
			<img src="<?= isset($photo) && $photo != NULL ? base_url($photo) : base_url('assets/img/static/avatar2.png') ?>" width="100px" height="100px" class="w3-left w3-circle w3-margin-right" id="preview"/>
			<div class="w3-right w3-col l6">
			    <button class="w3-button w3-green" onClick="browse(); return false;"> change business logo </button>
			    <input id="file" class="w3-input" type="file" name="photo" style="display:none;">
			</div>

			<div class="clearfix"></div>
		    </div>
		    <fieldset><legend>location of business</legend>
			<div class="w3-section">
			    <label class="w3-label w3-text-grey"><b>Country</b></label>
			    <?= Modules::run('Country/get_dropdown_option', 'country', (isset($country) ? $country : set_value('country')), 'class="w3-select w3-border" id="country"'); ?>
			</div>
			<div class="w3-section">
			    <label class="w3-label w3-text-grey"><b>State</b></label>
			    <?php $data = ['' => '--choose country first--']; ?>
			    <?= form_dropdown('state', $data, (isset($state) ? $state : set_value('state')), 'class="w3-select w3-border" id="state" data-selected="'.(isset($state) ? $state : set_value('state')).'"') ?>
			</div>
			<div class="w3-section">
			    <label class="w3-label w3-text-grey"><b>Local government Area.</b></label>
			    <?php $data = ['' => '--choose state first--']; ?>
			    <?= form_dropdown('lga', $data, (isset($lga) ? $lga : set_value('lga')), 'class="w3-select w3-border" id="lga" data-selected="'.(isset($lga) ? $lga : set_value('lga')).'"') ?>
			</div>
			<div class="w3-section">
			    <input class="w3-input w3-border" type="text" name="town" value="<?= isset($town) ? $town : set_value('town') ?>" placeholder="town/city">
			</div>
			<div class="w3-section">
			    <input class="w3-input w3-border" type="text" name="addr" value="<?= isset($addr) ? $addr : set_value('addr') ?>" placeholder="Company / Business address">
			</div>
		    </fieldset>

		</div>

		<div class="w3-clear"></div>
		<div class="w3-section">
		    <input class="w3-btn w3-green" type="submit" value="Update business profile" />
		</div>

	    </form>
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