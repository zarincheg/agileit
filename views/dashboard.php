<div class="container-fluid">
  <div class="row-fluid">
    <div class="span6">
      <h2>Bugs</h2>
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
      <ol class="wide-item" id="bug-list">
        <? foreach($bugs as $bug) { ?>
        <li>
          <a href="/task/<?= $bug['_id'] ?>"><?= $bug['name'] ?></a>
          <span class="badge badge-<?= $bug['status'] ?>"><?= $bug['status'] ?></span>
        </li>
        <? } ?>
      </ol>
    </div>
    <div class="span6">
      <h2>Features</h2>
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
      <ol class="wide-item" id="feature-list">
        <? foreach($features as $feature) { ?>
        <li>
          <a href="/task/<?= $feature['_id'] ?>"><?= $feature['name'] ?></a>
          <span class="badge badge-<?= $feature['status'] ?>"><?= $feature['status'] ?></span>
        </li>
        <? } ?>
      </ol>
    </div>
  </div>
</div>

<script type="text/template" id="task-item">
  <li>
    <a href="#"></a>
    <span class="badge badge-important">open</span>
  </li>
</script>

<script src="/js/dashboard.js"></script>