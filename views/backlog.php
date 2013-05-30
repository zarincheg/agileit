    <div class="container main">
      <div class="row-fluid">
        <div class="span9">
          <div class="input-append">
            <form action="/backlog/add" method="post" id="addBacklogForm">
              <input class="input-xxlarge" id="appendedInputButtons" type="text" name="record">
              <button class="btn" type="submit">Add</button>
            </form>
          </div>
          <ol class="wide-item" id="backlog">
            <?php while($backlog->hasNext()) {
              $item = $backlog->getNext();
            ?>
              <li data-rating="<?= $item['rating'] ?>" data-id="<?= $item['_id'] ?>">
                <span><?= $item['text'] ?></span>
                <a href="#"><i class="icon-remove"></i></a>
                <a href="#" onclick="backlogUp(this)">
                  <i class="icon-thumbs-up"></i>
                </a>
              </li>
            <? } ?>
          </ol>
        </div>
      </div>
    </div>

    <script type="text/template" id="backlog-item">
      <li>
        <span></span>
        <a href="#"><i class="icon-remove"></a></i>
        <a href="/backlog/up/"><i class="icon-thumbs-up"></a></i>
      </li>
    </script>