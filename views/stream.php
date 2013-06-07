<div class="container main">
  <div class="row-fluid">
    <div class="span9">
      <form action="/stream/add" id="addNoteForm">
        <textarea name="note" class="stream" rows="8"></textarea>
        <button class="btn btn-inverse" type="submit">Send</button>
      </form>
      <dl id="notes">
        <?php while($stream->hasNext()) {
          $item = $stream->getNext();
        ?>
          <dt data-id="<?= $item['_id'] ?>">
            <span><?= $item['author'] ?></span>
            <em class="small"><?= date("d-m-Y H:i", $item['date']->sec) ?></em>
          </dt>
          <dd><span><?= $item['text'] ?></span></dd>
        <? } ?>
      </dl>
    </div>
  </div>
</div>

<script type="text/template" id="note-item">
  <dt>
    <span></span>
    <em class="small"></em>
  </dt>
  <dd><span></span></dd>
</script>

<script src="/js/stream.js"></script>