<div class="container main">
  <div class="row-fluid">
    <div class="span9">
      <div class="row-fluid">
        <div class="span2">
          <h2>Task</h2>
        </div>
        <div class="span8 task-action">
          <div class="input-prepend" id="task-actions" data-task-id="<?= $_id ?>" data-task-status="<?= $status ?>">
            
            <? if($status == 'open') { ?>
            <button class="btn btn-success" type="button">Close</button>
            <? } elseif($status == 'close') {?>
            <button class="btn btn-danger" type="button">Open</button>
            <? } ?>

            <button class="btn btn-primary" type="button">Assign</button>
            <span class="add-on">to</span>
            <input class="input-large" id="appendedInputButton" type="text">
          </div>
        </div>
      </div>
      <h4><?= $name ?></h4>
      <p><?= $details ?></p>
      <div class="task-labels">
        <span class="label label-info">Branch</span>
        <span class="label label-inverse">Kirill Zorin</span>
      </div>
      <form action="" method="post">
        <textarea name="details" class="stream" rows="8"></textarea>
        <input type="submit" class="btn btn-inverse" value="Comment">
      </form>
    </div>
  </div>
</div>
<script src="/js/task.js"></script>