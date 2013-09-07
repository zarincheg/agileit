<div class="row" style="margin-top: 60pt;">
	<div class="col-xs-6 col-sm-4 col-md-10" style="margin-left: 50pt;">
		<div class="task-list-header" style="background-color: #fff;color: #1d1d1d;text-align: left;font-size: 18pt;border-bottom: 1pt solid #b91d47;margin-bottom: 2pt;">
		  <div style="display: inline; width: 40pt;position: fixed;height: 40pt; background-color: #b91d47;z-index: 10;" class="pull-left;"></div>
		  <span style="margin-left: 45pt;"><?= $name ?></span>
		</div>
		<?/* if($status == 'open') { */?><!--
			<button class="btn btn-success pull-right" type="button">Close</button>
		<?/* } elseif($status == 'close') {*/?>
			<button class="btn btn-danger pull-right" type="button">Open</button>
		--><? //} ?>



		<!--<div class="span8 task-action">
          <div class="input-prepend" id="task-actions" data-task-id="<?/*= $_id */?>" data-task-status="<?/*= $status */?>">
            <button class="btn btn-primary" type="button">Assign</button>
            <span class="add-on">to</span>
            <input class="input-large" id="appendedInputButton" type="text">
          </div>
        </div>-->

		<p class="task-details"><?= str_replace("\n", "<br>", $details); ?></p>

		<div class="task-actions">
			<button class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></button>
			<button class="btn btn-primary" id="comment-btn"
					data-container="body"
					data-toggle="popover"
					data-placement="bottom"
					data-content="Leave a comment"
					data-original-title="" title="">
				<span class="glyphicon glyphicon-comment"></span></button>
			<button class="btn btn-branch" id="branch-btn"
					data-container="body"
					data-toggle="popover"
					data-placement="bottom"
					data-content="Enter a branch name"
					data-original-title="" title="">
				<span class="octicon octicon-git-branch"></span></button>
			<button class="btn btn-assign"><span class="glyphicon glyphicon-user"></span></button>
		</div>

      <!--<div class="task-labels">
        <span class="label label-info">Branch</span>
        <span class="label label-inverse">Kirill Zorin</span>
      </div>
      <form action="" method="post">
        <textarea name="details" class="stream" rows="8"></textarea>
        <input type="submit" class="btn btn-primary" value="Comment">
      </form>-->
  </div>
</div>
<script type="text/template" id="popover-action">
	<div class="popover fade bottom">
		<div class="arrow"></div>
		<h3 class="popover-title" style="display: none;"></h3>

		<div class="popover-content"></div>
	</div>
</script>

<script src="/js/task.js"></script>