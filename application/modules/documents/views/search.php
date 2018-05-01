<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
	<div class="white-box">
	    <h3 class="box-title">Search result(s)</h3>
	    <ul class="list-inline text-right">
		<li>
		    <h5><i class="fa fa-circle m-r-5 text-info"></i>Mac</h5> </li>
		<li>
		    <h5><i class="fa fa-circle m-r-5 text-inverse"></i>Windows</h5> </li>
	    </ul>
	    <div id="ct-visits" style="height: 405px;">
		<form method="post" action="<?= site_url('search') ?>" class="form-horizontal form-material" id="search">
		    <div class="form-group">
			<div class="col-sm-2">
			    <select class="form-control form-control-line" name="doc_filter_col" id="document_filter_column">
				<option value="doc_filter_subject" selected="selected">Document Subject</option>
				<option value="doc_filter_author">Author</option>
				<option value="doc_filter_content">content</option>
			    </select>
			</div>
			<div class="col-sm-8">
			    <input type="text" name="doc_filter_value" id="document_filter_value" placeholder="Quick Search Documents" class="form-control form-control-line" />

			    <input type="text" class="col-sm-5 datepicker form-control form-control-line" name="doc_start_date" id="qds_date_start" placeholder="Start" style="width:194px; display: none;"/>

			    <input type="text" class="col-sm-5 pull-right datepicker form-control form-control-line" name="doc_stop_date" id="qds_date_end" placeholder="End (Optional)" style="width:194px; display: none;"/>

			    <select name="doc_types" id="qds_types" style="width:194px; display: none;" class="form-control form-control-line">
				<?php
				$doctypes = Modules::run('documents/get_doc_types');
				if (isset($doctypes) && count($doctypes) > 0): ?>
				    <option value="">choose..</option>
				   <?php foreach ( $doctypes as $d ):
					?>
					<option value="<?php echo $d->doctype_id ?>"><?php echo $d->doc_type ?></option>
				    <?php endforeach;
				endif;
				?>
			    </select>

			    <select class="form-control form-control-line" name="qds_categories" id="qds_categories" style="display: none;">
			    </select>

			    <select class="form-control form-control-line" name="qds_contacts" id="qds_contacts" style="width:194px; display: none;">
				<option value="1">John Doe</option>
			    </select>
			</div>
			<div class="col-sm-1">
			    <input  type="submit" name="search"	class="btn btn-default"	id="searchBtn" value="search"/>
			</div>
		    </div>
		    <div class="form-group">

		    </div>
		</form>
		<table cellpadding="0" cellspacing="0" width="100%" class="table table-condensed">
		    <thead style="background:rgba(0,0,0,0.1)" >
			<tr>
			    <th style="width: 1%;"></th>
			    <th style="width: 25%;">Document title</th>
			    <th style="width: 25%;">Document type</th>
			    <th style="width: 48%">Document content</th>
			</tr>
		    </thead>
		    <tbody>

		    </tbody>
		</table>

	    </div>
	</div>
    </div>
</div>

<script>
    $(document).ready(function ()
    {
        $('#document_filter_column').change(function () {

            $('#searchBtn').hide("fast");

            if ($(this).val() == 'doc_filter_type') {
                $('#qds_date_start').hide("fast");
                $('#qds_date_end').hide("fast");
                $('#qds_types').show("fast");
                $('#document_filter_value').hide("fast");
                $('#qds_categories').hide("fast");
                $('#qds_contacts').hide("fast");
            } else if ($(this).val() == 'doc_filter_doc_date' || $(this).val() == 'doc_filter_date_added') {
                $('#qds_date_start').show("fast");
                $('#qds_date_end').show("fast");
                $('#qds_types').hide("fast");
                $('#document_filter_value').hide("fast");
                $('#qds_categories').hide("fast");
                $('#qds_contacts').hide("fast");
            } else if ($(this).val() == 'document_filter_category') {
                $('#qds_date_start').hide("fast");
                $('#qds_date_end').hide("fast");
                $('#qds_types').hide("fast");
                $('#document_filter_value').hide("fast");
                $('#qds_categories').show("fast");
                $('#qds_contacts').hide("fast");
            } else if ($(this).val() == 'document_filter_from' || $(this).val() == 'document_filter_to') {
                $('#qds_date_start').hide("fast");
                $('#qds_date_end').hide("fast");
                $('#qds_types').hide("fast");
                $('#document_filter_value').hide("fast");
                $('#qds_categories').hide("fast");
                $('#qds_contacts').show("fast");
            } else {
                $('#qds_date_start').hide("fast");
                $('#qds_date_end').hide("fast");
                $('#qds_types').hide("fast");
                $('#document_filter_value').show("fast");
                $('#qds_categories').hide("fast");
                $('#qds_contacts').hide("fast");
            }

            $('#searchBtn').show("normal");

        });
	
	$(document).on('keyup', '#document_filter_value', function(){
	    var cols	= $('#document_filter_column').val();
	    var val	= $('#document_filter_value').val();
	   
	    search(cols,val);
	    
	});
	
	function search(col, val)
	{
	    SURL = $('#search').attr('action');
	    $.ajax({
		url: '<?= base_url('documents/ajax_search') ?>',
		data: {'col':col,'val':val},
		cache: false,
		type: 'POST',
		success: function(d){
		    var Sresult = JSON.parse(d);
		    $('tbody').html('');
		    var tagContent;
		    $.each(Sresult, function(i, res){
	
			switch (col)
			{
			    case 'doc_filter_author':
			    case 'doc_filter_subject':
				tagContent =  res.tags.substring(0, 145);
				break;
			    case 'doc_filter_content':
				tagContent =  res.tags.substring(res.tags.indexOf(val, 3), res.tags.indexOf(val, 3) + 145);
				break;
			}
			
			var row = $('<tr>'+
				    '<td> <a href="'+baseurl+'documents/read/'+res.doc_id+'" class="btn btn-info"><i class="fa fa-eye"></i></a> </td>'+
				    '<td> '+res.title+' </td>'+
				    '<td> '+res.author+' </td>'+
				    '<td> '+ tagContent+' </td>'+
				    '</tr>'
				    );
			$('tbody').append(row);
		    });
		    
		    
			    
		}
	    });
	}
    });
</script>