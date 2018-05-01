<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
	<div class="white-box">
	    <h3 class="box-title">User profile</h3>
	    <ul class="list-inline text-right">
		<li>
		    <h5><i class="fa fa-circle m-r-5 text-info"></i>Mac</h5> </li>
		<li>
		    <h5><i class="fa fa-circle m-r-5 text-inverse"></i><?= anchor('users/view', 'back', 'class="btn btn-default"') ?></h5> </li>
	    </ul>
	    <div id="ct-visits" style="min-height: 405px;">
		<table cellpadding="0" cellspacing="0" width="100%" class="table table-condensed table-bordered">
		    <tbody>
			<tr>
			    <th>Name</th>
			    <td><?= $user->firstname ?> <?= $user->lastname ?></td>
			</tr>
			<tr>
			    <th>Email</th>
			    <td><?= $user->email ?></td>
			</tr>
			<tr>
			    <th>Phone</th>
			    <td><?= $user->phone ?></td>
			</tr>
			<tr>
			    <th>Phone</th>
			    <td><?= $user->username ?></td>
			</tr>
			<tr>
			    <th>Role</th>
			    <td><?= $user->is_admin == 0 ?'Subscriber':'Administrator' ?></td>
			</tr>
			<tr>
			    <th>Registration date</th>
			    <td><?= $user->regdate ?></td>
			</tr>
			
		    </tbody>
		    
		</table>

	    </div>
	</div>
    </div>
</div>
