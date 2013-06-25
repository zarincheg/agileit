    <div class="container main">
      <div class="row">
        <div class="span8">
          
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
                <ul class="unstyled wide-item branch-list">
                  <?
                  $badge = function($status) {
                    $badges = ['review' => 'info',
                               'fix' => 'important',
                               'testing' => 'warning',
                               'complete' => 'success'];
                    return $badges[$status];
                  };

                  foreach ($list as $branch) { ?>
                  <li>
                    <div class="badge-empty badge-<?= $badge($branch['status']) ?> li-before"></div>
                    <a data-toggle="collapse" href="#branch-acts-<?= $branch['name'] ?>"><?= $branch['name'] ?></a>
                    <div id="branch-acts-<?= $branch['name'] ?>" class="collapse">
                      <span class="label label-success">Complete</span>
                      <span class="label label-warning">Testing</span>
                      <span class="label label-important">Fix</span>
                      <span class="label label-info">Review</span>
                    </div>
                  </li>
                  <? } ?>
                </ul>
              </div>

              <div class="tab-pane active" id="tab1">
                <ol class="wide-item">
                  <li>Any Bug/Task</li>
                  <li>
                    <a data-toggle="collapse" href="#branch">patch-site-pages</a>
                    <div class="badge-empty badge-success"></div>
                    <div id="branch" class="collapse">
                      <span class="label label-success">Complete</span>
                      <span class="label label-warning">Testing</span>
                      <span class="label label-important">Fix</span>
                      <span class="label label-info">Review</span>
                    </div>
                  </li>
                  <li>
                    <a href="#">Any Bug/Task</a>
                    <div class="badge-empty badge-important"></div>
                  </li>
                  <li>Any Bug/Task</li>
                  <li>Any Bug/Task</li>
                  <li>Any Bug/Task</li>
                  <li>Any Bug/Task</li>
                  <li><a href="#">Any Bug/Task</a>
                    <div class="badge-empty badge-info"></div>
                  </li>
                  <li>Any Bug/Task</li>
                </ol>
              </div>
              <div class="tab-pane" id="tab2">
                <ul class="nav nav-pills">
                  <li class="active">
                    <a href="#">Merged</a>
                  </li>
                  <li>
                    <a href="#">Not merged</a>
                  </li>
                </ul>
                <ol class="wide-item">
                  <li>Any Bug/Task</li>
                  <li>
                    <a href="#">Any Bug/Task</a>
                    <span class="badge badge-important">O</span>
                  </li>
                  <li>
                    <a href="#">Any Bug/Task</a>
                    <span class="badge badge-important">O</span>
                  </li>
                  <li>Any Bug/Task</li>
                  <li>Any Bug/Task</li>
                  <li>Any Bug/Task</li>
                  <li>Any Bug/Task</li>
                  <li><a href="#">Any Bug/Task</a>
                    <span class="badge badge-important">O</span>
                  </li>
                  <li>Any Bug/Task</li>
                </ol>
              </div>
              <div class="tab-pane" id="tab3">
                <ul class="nav nav-pills">
                  <li class="active">
                    <a href="#">Merged</a>
                  </li>
                  <li>
                    <a href="#">Not merged</a>
                  </li>
                </ul>
                <ol class="wide-item">
                  <li>Any Bug/Task</li>
                  <li>
                    <a href="#">Any Bug/Task</a>
                    <span class="badge badge-important">O</span>
                  </li>
                  <li>
                    <a href="#">Any Bug/Task</a>
                    <span class="badge badge-important">O</span>
                  </li>
                  <li>Any Bug/Task</li>
                  <li>Any Bug/Task</li>
                  <li>Any Bug/Task</li>
                  <li>Any Bug/Task</li>
                  <li><a href="#">Any Bug/Task</a>
                    <span class="badge badge-important">O</span>
                  </li>
                  <li>Any Bug/Task</li>
                </ol>
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
                        <button class="btn btn-mini btn-primary inline" type="button" data-toggle="modal" data-target="#addBranch">Add branch</button>
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
        <a href="#" class="btn btn-inverse">Add</a>
      </div>
    </div>