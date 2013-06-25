<div class="container main">
  <div class="row-fluid">
    <div class="span9">
      <div class="input-append">
        <form action="/backlog/add" method="post" id="addBacklogForm">
          <input class="input-xxlarge" id="appendedInputButtons" type="text" name="record">
          <button class="btn" type="submit"><i class="icon-plus"></i> Add</button>
        </form>
      </div>
      <ol class="wide-item" id="backlog">
        <?php while($backlog->hasNext()) {
          $item = $backlog->getNext();
        ?>
          <li data-rating="<?= $item['rating'] ?>" data-id="<?= $item['_id'] ?>">
            <span><?= $item['text'] ?></span>
            <i class="icon-remove"></i>
            <i class="icon-thumbs-up"></i>
          </li>
        <? } ?>
      </ol>
    </div>
  </div>
</div>

<script type="text/template" id="backlog-item">
  <li>
    <span></span>
    <i class="icon-remove"></i>
    <i class="icon-thumbs-up"></i>
  </li>
</script>

<script type="text/template" id="confirm-remove">
  <div class="alert alert-error fade">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 class="alert-heading">Remove confirmation</h4>
    <p>Are you sure want to remove backlog item?</p>
    <p class="confirm-buttons">
      <a class="btn btn-danger" href="#">Yes</a>
      <a class="btn btn-cancel" href="#">No</a>
    </p>
  </div>
</script>

<script src="/js/backlog.js"></script>