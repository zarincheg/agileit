<div class="container-fluid">
  <div class="row-fluid">
    <div class="span6">
	  <div class="task-list-header bugs-list-header">Bugs</div>
      <div class="input-append">
      <form id="addBugForm">
        <input class="input-xlarge" id="appendedInputButtons" type="text" name="name">
        <button class="btn" type="submit"><i class="icon-plus"></i> Add</button>
        <button class="btn" type="button" data-toggle="collapse" data-target="#bug-detail"><i class="icon-align-right"></i> Details</button>
        <div id="bug-detail" class="collapse">
          <textarea name="details" class="input-xlarge details" rows="5"></textarea>
        </div>
      </form>
      </div>
      <ol class="wide-item unstyled" id="bug-list">
        <? foreach($bugs as $bug) { ?>
        <li>
	      <span class="badge badge-<?= $bug['status'] ?>"><?= $bug['status'] ?></span>
          <a href="/task/<?= $bug['_id'] ?>"><?= $bug['name'] ?></a>
        </li>
        <? } ?>
      </ol>
    </div>
    <div class="span6">
      <div class="task-list-header">Features</div>
      <div class="input-append">
      <form id="addFeatureForm">
          <input class="input-xlarge" id="appendedInputButtons" type="text" name="name">
          <button class="btn" type="submit"><i class="icon-plus"></i> Add</button>
          <button class="btn" type="button" data-toggle="collapse" data-target="#feature-detail"><i class="icon-align-right"></i> Details</button>
          <div id="feature-detail" class="collapse">
            <textarea name="details" class="input-xlarge details" rows="5"></textarea>
          </div>
      </form>
      </div>
      <ol class="wide-item unstyled" id="feature-list">
        <? foreach($features as $feature) { ?>
        <li class="slim-badge slim-badge-<?= $feature['status'] ?>">
	      <!--<span class="badge badge-<?/*= $feature['status'] */?>"><?/*= $feature['status'] */?></span>-->
          <a href="/task/<?= $feature['_id'] ?>"><?= $feature['name'] ?></a>
        </li>
        <? } ?>
      </ol>
    </div>
  </div>
</div>

<script type="text/template" id="task-item">
  <li>
	<span class="badge badge-important">open</span>
    <a href="#"></a>
  </li>
</script>

<script src="/js/dashboard.js"></script>