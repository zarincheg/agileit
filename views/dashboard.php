<div class="row" style="margin-top: 45pt;">
	<div class="col-xs-6 col-sm-4 col-md-5" id="bugs-chart" style="margin-left: 50pt;height: 180pt;"></div>
	<div class="col-xs-6 col-sm-4 col-md-5" id="features-chart" style="height: 180pt;"></div>
</div>
<div class="row">
    <div class="col-xs-6 col-sm-4 col-md-5" style="margin-left: 50pt;">
	  <div class="task-list-header bugs-list-header">Bugs</div>
      <div class="input-append">
	      <form id="addBugForm" role="form">
	        <div class="input-group">
		        <label class="sr-only" for="b-name">Name</label>
			    <input class="form-control" id="b-name" type="text" name="name">

		        <div class="input-group-btn">
			        <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#bug-detail">
						<span class="glyphicon glyphicon-pencil"></span> Details</button>
		            <button class="btn btn-success" type="submit">Add</button>
			    </div>
		    </div>

			<div id="bug-detail" class="collapse">
			  <textarea name="details" class="details" rows="5"></textarea>
			</div>
	      </form>
      </div>
      <ol class="wide-item unstyled" id="bug-list">
        <? foreach($bugs as $bug) { ?>
        <li>
		  <span class="glyphicon status-icon-<?= $bug['status'] ?>"></span>
          <a href="/task/<?= $bug['_id'] ?>"><?= $bug['name'] ?></a>
        </li>
        <? } ?>
      </ol>
    </div>

	<div class="col-xs-6 col-sm-4 col-md-5">
      <div class="task-list-header">Features</div>
      <div class="input-append">
		  <form id="addFeatureForm" role="form">
			<div class="input-group">
			  <label class="sr-only" for="f-name">Name</label>
	          <input class="form-control" id="f-name" type="text" name="name">

			  <div class="input-group-btn">
				<button class="btn btn-default" type="button" data-toggle="collapse" data-target="#feature-detail">
					<span class="glyphicon glyphicon-pencil"></span> Details</button>
				<button class="btn btn-success" type="submit"><i class="icon-plus"></i> Add</button>
			  </div>
			</div>

			<div id="feature-detail" class="collapse">
				<textarea name="details" class="details" rows="5"></textarea>
			</div>
	      </form>
      </div>
      <ol class="wide-item unstyled" id="feature-list">
        <? foreach($features as $feature) { ?>
        <li><span class="glyphicon status-icon-<?= $feature['status'] ?>"></span>
          <a href="/task/<?= $feature['_id'] ?>"><?= $feature['name'] ?></a>
        </li>
        <? } ?>
      </ol>
    </div>
</div>

<script type="text/template" id="task-item">
  <li>
	<span class="glyphicon status-icon-open"></span>
    <a href="#"></a>
  </li>
</script>

<script src="/js/highcharts/highcharts.js"></script>
<script src="/js/dashboard.js"></script>