<?php
$db = $view = new view();
$documents=$view->document_mappings($request['RequestID']);
?>
<div class="modal fade" id="modal<?php  echo $request['RequestID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fs-5" id="exampleModalLabel">Request Details</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="px-2" style="font-size: 1rem; text-transform: capitalize">
                    <?php if ($request['RequestType'] == 'personal'){?>
                        <div class="row py-1 border-bottom">
                            <div class="col-4 py-2">Type:</div>
                            <div class="col-8 py-2 bg-light"><?php  echo $request['RequestType']; ?></div>
                        </div>
                    <?php } else {?>
                        <div class="row py-1 border-bottom">
                            <div class="col-4 py-2">Authorized Personnel:</div>
                            <div class="col-8 py-2 bg-light">
                                <?php  echo 'Full name: '.$request['AuthorizedPersonnelName']?><br>
                                <?php  echo 'Address: '.$request['AuthorizedAddress']?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Full name:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['StudentFullName']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Email:</div>
                        <div class="col-8 py-2 bg-light text-lowercase"><?php  echo $request['StudentEmail']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Address:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['StudentAddress']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Gender:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['StudentGender']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Phone:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['StudentPhone']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Department:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['Department']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Course:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['Course']; ?></div>
                    </div>
                    <div class="row py-1 border-bottom">
                        <div class="col-4 py-2">Education:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo $request['Education']; ?></div>
                    </div>

                    <div class="row py-1 border-bottom">
                        <div class="col-4">Schedule:</div>
                        <div class="col-8 py-2 bg-light"><?php  echo date('F d, Y | h: i a', strtotime($request['Schedule'])); ?></div>
                    </div>
                    <div class="row py-1 ">
                        <div class="col-4 py-2">Requested documents:</div>
                        <div class="col-8 py-2 bg-light"><ul><?php foreach($documents as $document){?><?php  echo '<li>'.$document['DocumentName'].'</li>'; } ?></ul></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete<?php  echo $request['RequestID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="deleteModalLabel"><i class="fas fa-exclamation-triangle"></i> Delete Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you absolutely certain that you want to delete this request? Once deleted, it cannot be recovered or undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form class="m-0" action="RequestHandler/deleteRequest.php" method="POST">
                    <input type="hidden" name="request_id" value="<?php echo $request['RequestID']; ?>">
                    <button type="submit" name="deleteRequest" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>