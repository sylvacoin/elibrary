<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
	<div class="white-box">
	    <h3 class="box-title"><?= isset($page_title) ? $page_title : "" ?></h3>
	    <ul class="list-inline text-right">
		<li>
		    <h5><i class="fa fa-circle m-r-5 text-info"></i>Mac</h5> </li>
		<li>
		    <h5><i class="fa fa-circle m-r-5 text-inverse"></i>Windows</h5> </li>
	    </ul>
	    <div class="" role="tabpanel" data-example-id="togglable-tabs">
		<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
		    <li role="presentation" class="active">
			<a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-cloud-upload"></i> Friend Requests</a></li>
		    <li role="presentation" class="">
			<a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-book"></i> Pending Requests</a></li>
		</ul>
		<div id="myTabContent" class="tab-content">
		    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
			<?php
			if ($this->session->flashdata('error') != NULL) {
			    echo DIV_ERR . $this->session->flashdata('error') . DIV_CLOSE;
			}

			if ($this->session->flashdata('success') != NULL) {
			    echo DIV_SUCCESS . $this->session->flashdata('success') . DIV_CLOSE;
			}
			?>
			<?= validation_errors(DIV_ERR, DIV_CLOSE) ?>

			<?= Modules::run('users/requests') ?>
		    </div>
		    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
			<?= Modules::run('users/pending_requests') ?>
		    </div>
		</div>
	    </div>
	</div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#docEditionParent, #docContactsParent, #docPswdParent, #docPswd1Parent, #actionParent').hide();

        $('#btnUpload').click(function () {
            $('#file').click();
        });

        //if you click to upload a file
        $('#file').change(function () {
            $('#actionParent').show('fast');

            if (console.log($('#file')[0].files.length) == 0) {
                return false;
            }

            $("#btnUpload").attr("disabled", true);

            var data = new FormData();
            var elV = document.getElementById("progressvalue");
            var elP = document.getElementById("percent");
            var elE = document.getElementById("elapsed");
            var percentUploaded = 0;

            $.each(jQuery('#file')[0].files, function (i, file) {
                data.append('file', file);
            });

            $.ajax({
                url: "<?= base_url() . 'documents/ajax_upload_data' ?>",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                xhr: function () {
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) {
                        myXhr.upload.addEventListener('progress', function (ev) {
                            if (ev.lengthComputable) {
                                percentUploaded = Math.floor(ev.loaded * 100 / ev.total).toFixed(0);
                                elP.innerHTML = percentUploaded + '%';
                                elV.style.width = percentUploaded + '%';
                                elE.innerHTML = (ev.loaded / 1000000).toFixed(2) + ' MB loaded';

                            }
                        }, false);
                    }
                    return myXhr;
                },
                success: function (data) {
                    var d = JSON.parse(data);

                    $("#progressvalue").width('100%');
                    $(".percent").html('100%');
                    $(".elapsed").html('<span style="color: #436b80; font-weight: bold;">Upload complete!</span>');
                    $('#actionParent').hide('fast');
                    $(".filesDown").slideUp("normal", function () {
                        $(".file-row").remove();
                        $(d.result).insertAfter('#elder-list');
                        $('#docTitle').val(d.doc_data['title']);
                        $('#docAuthor').val(d.doc_data['author']);
                        if (isNaN(d.doc_data['category']))
                        {
                            $('#docCat2').val(d.doc_data['category']);
                            $('#form_category_id').hide();
                            $('#category_add_label').hide();
                            $('#category_add_div').show();
                            $('#category_cancel_label').show();
                        } else {
                            $('#docCat').val(d.doc_data['category']);
                            $('#hidden').val(d.doc_data['category']);
                            $('#category_add_div').hide();
                            $('#category_cancel_label').hide();
                            $('#form_category_add').val('');
                            $('#form_category_id').show();
                            $('#category_add_label').show();
                        }
                        $.ajax({
                            url: "<?= base_url('category/get_ajax_dropdown') ?>",
                            data: {id: $('#hidden').val()},
                            type: 'POST',
                            success: function (data) {
                                $("#form_category_id").html(data);
                            }
                        });

                    });
                    $(".filesDown").slideDown("fast");
                    $("#upload-form")[0].reset();
                    $("#btnUpload").attr("disabled", false);

                    percentUploaded = 0;

                }
            });

        });

        $(document).on('change', '#docHasEdition', function () {
            var ischecked = $(this).val();
            if (ischecked == 'true')
            {
                $('#docEditionParent').show();
            } else {
                $('#docEditionParent').hide();
            }
        });
        $(document).on('change', '#docHasPswd', function () {
            var ischecked = $(this).val();
            if (ischecked == 1)
            {
                $('#docPswdParent, #docPswd1Parent').show();
            } else {
                $('#docPswdParent, #docPswd1Parent').hide();
            }
        });
        $(document).on('change', '#docAccess', function () {
            var option = $(this).val();
            if (option === 'specific')
            {
                $('#docContactsParent').show();
            } else {
                $('#docContactsParent').hide();
                $('#docContacts').val('');
            }
        });

        $('#type_add_label').click(function () {
            $('#form_type_id').hide();
            $('#type_add_label').hide();
            $('#type_add_div').show();
            $('#type_cancel_label').show();
        });
        $('#type_cancel_label').click(function () {
            $('#type_add_div').hide();
            $('#type_cancel_label').hide();
            $('#form_type_add').val('');
            $('#form_type_id').show();
            $('#type_add_label').show();
        });
        $('#category_add_label').click(function () {
            $('#form_category_id').hide();
            $('#category_add_label').hide();
            $('#category_add_div').show();
            $('#category_cancel_label').show();
        });
        $('#category_cancel_label').click(function () {
            $('#category_add_div').hide();
            $('#category_cancel_label').hide();
            $('#form_category_add').val('');
            $('#form_category_id').show();
            $('#category_add_label').show();
        });


        $.ajax({
            url: "<?= base_url('category/get_ajax_dropdown') ?>",
            data: {id: $('#hidden').val()},
            type: 'POST',
            success: function (data) {
                $("#form_category_id").html(data);
            }
        });

    });
</script>

