<div class="col-sm-12">
    <div class="col-sm-2">
        <ul class="nav nav-stacked">
            <li><a href="<?= site_url('documents/view') ?>">All</a></li>
            <li><a href="<?= site_url('documents/view/document') ?>">Documents</a></li>
            <li><a href="<?= site_url('documents/view/recording') ?>">Recordings</a></li>
        </ul>
    </div>

    <div class="col-sm-10">
        <div class="panel panel-warning">
            <div class="panel-heading">
                Saved Documents
            </div>
            <div class="panel-body">
            <div class="dataTable_wrapper">
            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="dataTables-example_wrapper">
                <div class="row">
                <div class="col-sm-12">
                <table aria-describedby="dataTables-example_info" role="grid" class="table table-striped table-bordered table-hover dataTable no-footer" id="example">
                <thead>
                    <tr role="row">
                        <th aria-label="Browser: activate to sort column ascending" style="width: 149px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting" colspan="2">Document Title</th>
                        <th aria-label="Platform(s): activate to sort column ascending" style="width: 78px" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting"> Document Type</th>
                        <th aria-label="Engine version: activate to sort column ascending" style="width: 110px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting"> Description</th>
                        <th aria-label="CSS grade: activate to sort column ascending" style="width: 117px;;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting">Date Added</th>
                        <th aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" style="width: 150px;" colspan="1" rowspan="1" aria-controls="dataTables-example" tabindex="0" class="sorting_asc">&nbsp;</th>
                    </tr>
                </thead>
            <?php foreach ($documents as $doc): ?>
            <tr>
                <td>
                <?php
                    $doctype = substr($doc->filepath, strpos($doc->filepath, '.'));
                    switch ($doctype){
                        case '.doc':
                            $display = '';
                            echo '<img src="'.base_url('assets/img/doc.png').'" width="25px" height="25px" class="img-responsive img-thumbnail" />';
                            break;
                        case '.docx':
                            $display= $doc->filepath;
                            echo '<img src="'.base_url('assets/img/doc.png').'" width="25px" height="25px" class="img-responsive img-thumbnail" />';
                            break;
                        case '.pdf':
                            $display = '<script type="text/javascript">PDFObject.embed("'.$doc->filepath.'","#canvas'.$doc->doc_id.'");</script>'
                                . '<div id="canvas'.$doc->doc_id.'"></div>';
                            echo '<img src="'.base_url('assets/img/doc.png').'" width="25px" height="25px" class="img-responsive img-thumbnail" />';
                            break;
                        case '.zip':
                            $display = '';
                            echo '<img src="'.base_url('assets/img/zip.png').'" width="25px" height="25px" class="img-responsive img-thumbnail" />';
                            break;
                        case '.mp3':
                            $display = '<audio controls>
                                            <source src="'.$doc->filepath.'" type="audio/ogg">
                                            <source src="'.$doc->filepath.'" type="audio/mpeg">
                                          Your browser does not support the audio element.
                                        </audio> ';
                            echo '<img src="'.base_url('assets/img/mp3.png').'" width="25px" height="25px" class="img-responsive img-thumbnail" />';
                            break;
                        case '.mp4':
                            $display = '<video width="320" height="240" controls>
                                            <source src="'.  $doc->filepath .' " type="video/mp4">
                                            <source src="'.  $doc->filepath .' " type="video/ogg">
                                          Your browser does not support the video tag.
                                        </video>';
                            
                            echo '<img src="'.base_url('assets/img/mp4.png').'" width="25px" height="25px" class="img-responsive img-thumbnail" />';
                            break;
                        case '.flv':
                            echo '<img src="'.base_url('assets/img/flv.png').'" width="25px" height="25px" class="img-responsive img-thumbnail" />';
                            break;
                        default:
                            echo '<img src="'.base_url('assets/img/default.png').'" width="25px" height="25px" class="img-responsive img-thumbnail" />';
                            break;    
                    }
                ?>
               <?= $doc->title; ?></td>
                <td><?= $doc->type; ?></td>
                <td><?= $doc->description; ?></td>
                <td><?= $doc->date_added; ?></td>
                <td>
                <?= anchor('documents/edit/'.$doc->doc_id, '<i class="fa fa-edit"></i> Edit', 'class="pull-left"') ?> &nbsp;&nbsp;&nbsp;
                <?php if (isset($doc->type) && $doc->type == 'recording') : ?>
                <a href="#previewModal<?= $doc->doc_id ?>" id="uid<?= $doc->doc_id ?>" data-toggle="modal" class="text-primary text-center"><i class="fa fa-play"></i> Play</a>
                <?php else:
                    echo anchor('documents/download/'.$doc->doc_id, '<i class="fa fa-fw fa-download"></i> Download');
                endif; ?>

                <a href="#deleteModal<?= $doc->doc_id ?>" id="uid<?= $doc->doc_id ?>" data-toggle="modal" class="text-danger pull-right"><i class="fa fa-trash"></i> Delete</a>
                </td>
                
                <!-- document delete modal -->
                    <div id="deleteModal<?= $doc->doc_id ?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3><i class="fa fa-trash-o"></i> Delete Dialog</h3> 
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger text-center">
                                        Are you Sure you Want to <strong>Delete</strong>&nbsp; this Document
                                        <b><?= $doc->title ?>?</b> <br>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
                                    <a href="<?= site_url('documents/delete/'.$doc->doc_id) ?>" class="btn btn-danger"><i class="icon-trash icon-large"></i>&nbsp;Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end delete modal -->
                    
                    <!-- Document view modal -->
                    <div id="previewModal<?= $doc->doc_id ?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3><i class="fa fa-trash-o"></i>Showing <?= $doc->title ?></h3> 
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-primary text-center">
                                        <?= $display; ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end delete modal -->
            </tr>
            <?php endforeach; ?>
            </tbody>
             </table>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>