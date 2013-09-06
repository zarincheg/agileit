<?
$badge = function($status) {
  $badges = ['review' => 'info',
             'fixing' => 'important',
             'testing' => 'warning',
             'complete' => 'success'];
  return $badges[$status];
};
?>
    <div class="container main">
      <div class="row">
        <div class="span12">
          
          <div class="tabbable"> <!-- Only required for left/right tabs -->
            <ul class="nav nav-pills">
              <li><a href="#tab5" data-toggle="tab">List</a></li>
              <li class="active"><a href="#tab1" data-toggle="tab">Review</a></li>
              <li><a href="#tab2" data-toggle="tab">Bugfix</a></li>
              <li><a href="#tab3" data-toggle="tab">Feature</a></li>
              <li><a href="#tab4" data-toggle="tab">Builds</a></li>
            </ul>
            <div class="tab-content state-content">
              <div class="tab-pane" id="tab5">
                <ul class="wide-item unstyled branch-list">
                  <? foreach($list as $branch) { ?>
                  <li>
	                <div class="square-badge status-<?= $branch['status'] ?>"></div>
                    <a data-toggle="collapse" href="#branch-acts-<?= $branch['name'] ?>"><?= $branch['name'] ?></a>
                    | taskName, Kirill Zorin
                    <div id="branch-acts-<?= $branch['name'] ?>" class="collapse branch-acts">
                      <span class="label label-warning" onclick="setStatus('<?= $branch['name'] ?>', 'testing')">Testing</span>
                      <span class="label label-important" onclick="setStatus('<?= $branch['name'] ?>', 'fixing')">Fixing</span>
                      <span class="label label-info" onclick="setStatus('<?= $branch['name'] ?>', 'review')">Review</span>
                    </div>
                  </li>
                  <? } ?>
                </ul>
              </div>

              <div class="tab-pane active" id="tab1">
                <ul class="wide-item unstyled branch-list">
                  <? foreach($reviewList as $branch) { ?>
                  <li>
                    <a data-toggle="collapse" href="#branch-rwacts-<?= $branch['name'] ?>"><?= $branch['name'] ?></a>
                    | taskName, Kirill Zorin
                    <div id="branch-rwacts-<?= $branch['name'] ?>" class="collapse branch-acts">
                      <span class="label label-warning" onclick="setStatus('<?= $branch['name'] ?>', 'testing')">Testing</span>
                      <span class="label label-important" onclick="setStatus('<?= $branch['name'] ?>', 'fixing')">Fixing</span>
                    </div>
                  </li>
                  <? } ?>
                </ul>
              </div>
              
              <div class="tab-pane" id="tab2">
                <div class="row-fluid">
                  <div class="span6">
                    Merged
                    <ul class="wide-item unstyled branch-list">
                      <? foreach($bugList as $branch) { 
                        if(!in_array('fix-testing', $branch['merged'])) continue; ?>
                      <li>
	                    <div class="square-badge status-<?= $branch['status'] ?>"></div>
                        <a data-toggle="collapse" href="#branch-fxacts-<?= $branch['name'] ?>"><?= $branch['name'] ?></a>
                        | taskName, Kirill Zorin
                        <div id="branch-fxacts-<?= $branch['name'] ?>" class="collapse branch-acts">
                          <span class="label label-success" onclick="setStatus('<?= $branch['name'] ?>', 'complete')">Complete</span>
                          <span class="label label-warning" onclick="setStatus('<?= $branch['name'] ?>', 'testing')">Testing</span>
                          <span class="label label-important" onclick="setStatus('<?= $branch['name'] ?>', 'fixing')">Fixing</span>
                          <span class="label label-info" onclick="setStatus('<?= $branch['name'] ?>', 'review')">Review</span>
                        </div>
                      </li>
                      <? } ?>
                    </ul>
                  </div>
                  <div class="span6">
                    Not merged
                    <ul class="wide-item unstyled branch-list">
                      <? foreach($bugList as $branch) { 
                        if(in_array('fix-testing', $branch['merged'])) continue; ?>
                      <li>
	                    <div class="square-badge status-<?= $branch['status'] ?>"></div>
                        <a data-toggle="collapse" href="#branch-fxacts-<?= $branch['name'] ?>"><?= $branch['name'] ?></a>
                        | taskName, Kirill Zorin
                        <div id="branch-fxacts-<?= $branch['name'] ?>" class="collapse branch-acts">
                          <span class="label label-success" onclick="setStatus('<?= $branch['name'] ?>', 'complete')">Complete</span>
                          <span class="label label-warning" onclick="setStatus('<?= $branch['name'] ?>', 'testing')">Testing</span>
                          <span class="label label-important" onclick="setStatus('<?= $branch['name'] ?>', 'fixing')">Fixing</span>
                          <span class="label label-info" onclick="setStatus('<?= $branch['name'] ?>', 'review')">Review</span>
                        </div>
                      </li>
                      <? } ?>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="tab3">
                <div class="row-fluid">
                  <div class="span6">
                    Merged
                    <ul class="wide-item unstyled branch-list">
                      <? foreach($featureList as $branch) { 
                        if(!in_array('feature-testing', $branch['merged'])) continue; ?>
                      <li>
	                    <div class="square-badge status-<?= $branch['status'] ?>"></div>
                        <a data-toggle="collapse" href="#branch-ftacts-<?= $branch['name'] ?>"><?= $branch['name'] ?></a>
                        | taskName, Kirill Zorin
                        <div id="branch-ftacts-<?= $branch['name'] ?>" class="collapse branch-acts">
                          <span class="label label-success" onclick="setStatus('<?= $branch['name'] ?>', 'complete')">Complete</span>
                          <span class="label label-warning" onclick="setStatus('<?= $branch['name'] ?>', 'testing')">Testing</span>
                          <span class="label label-important" onclick="setStatus('<?= $branch['name'] ?>', 'fixing')">Fixing</span>
                          <span class="label label-info" onclick="setStatus('<?= $branch['name'] ?>', 'review')">Review</span>
                        </div>
                      </li>
                      <? } ?>
                    </ul>
                  </div>
                  <div class="span6">
                    Not merged
                    <ul class="wide-item unstyled branch-list">
                      <? foreach($featureList as $branch) { 
                        if(in_array('feature-testing', $branch['merged'])) continue; ?>
                      <li>
	                    <div class="square-badge status-<?= $branch['status'] ?>"></div>
                        <a data-toggle="collapse" href="#branch-ftacts-<?= $branch['name'] ?>"><?= $branch['name'] ?></a>
                        | taskName, Kirill Zorin
                        <div id="branch-ftacts-<?= $branch['name'] ?>" class="collapse branch-acts">
                          <span class="label label-success" onclick="setStatus('<?= $branch['name'] ?>', 'complete')">Complete</span>
                          <span class="label label-warning" onclick="setStatus('<?= $branch['name'] ?>', 'testing')">Testing</span>
                          <span class="label label-important" onclick="setStatus('<?= $branch['name'] ?>', 'fixing')">Fixing</span>
                          <span class="label label-info" onclick="setStatus('<?= $branch['name'] ?>', 'review')">Review</span>
                        </div>
                      </li>
                      <? } ?>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="tab4">
                
                <div class="accordion" id="accordion2">
                  <div class="accordion-group">
                    <div class="accordion-heading">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                        Build 05
                      </a>
                    </div>
                    <div id="collapseOne" class="accordion-body collapse">
                      <div class="accordion-inner">
                        <ul class="unstyled">
                          <li>patch-pass-retrive</li>
                          <li>remotes/origin/10237_fast_audit</li>
                          <li>remotes/origin/405_concurrents</li>
                          <li>remotes/origin/437_profVersionFixes</li>
                        </ul>
                        <button class="btn btn-mini btn-primary inline" type="button">Add branch</button>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="accordion" id="accordion3">
                  <div class="accordion-group">
                    <div class="accordion-heading">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapseTwo">
                        Build 06
                      </a>
                    </div>
                    <div id="collapseTwo" class="accordion-body collapse">
                      <div class="accordion-inner">
                        <ul class="unstyled">
                          <li>patch-pass-retrive</li>
                          <li>remotes/origin/10237_fast_audit</li>
                          <li>remotes/origin/405_concurrents</li>
                          <li>remotes/origin/437_profVersionFixes</li>
                        </ul>
                        <button class="btn btn-mini btn-primary inline" type="button" data-toggle="modal" data-target="#addBranch"><i class="icon-plus icon-white"></i> Add branch</button>
                      </div>
                    </div>
                  </div>
                </div>

                <a href="#newBuild" role="button" class="btn btn-inverse" data-toggle="modal">Create build</a>
                 
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal hide fade" id="newBuild">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>New build</h3>
      </div>
      <div class="modal-body">
        <form action="" method="post" class="new-build">
          <div>
            <input type="text" name="buildName" class="input-xlarge" placeholder="Name">
          </div>
          <div>
            <select multiple="multiple" class="input-xlarge">
              <option>patch-pass-retrive</option>
              <option>remotes/origin/10237_fast_audit</option>
              <option>remotes/origin/405_concurrents</option>
              <option>remotes/origin/437_profVersionFixes</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn">Cancel</a>
        <a href="#" class="btn btn-inverse">Create</a>
      </div>
    </div>

    <div class="modal hide fade" id="addBranch">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Adding branches</h3>
      </div>
      <div class="modal-body">
        <form action="" method="post" class="new-build">
          <div>
            <select multiple="multiple" class="input-xlarge">
              <option>patch-pass-retrive</option>
              <option>remotes/origin/10237_fast_audit</option>
              <option>remotes/origin/405_concurrents</option>
              <option>remotes/origin/437_profVersionFixes</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn">Close</a>
        <a href="#" class="btn btn-inverse"><i class="icon-plus icon-white"></i> Add</a>
      </div>
    </div>

<script src="/static/js/branches.js"></script>