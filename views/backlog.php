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
            <?php while($backlog->hasNext()) {?>
              <li>
                <span><?= $backlog->getNext()['text'] ?></span>
                <a href="#"><i class="icon-remove"></a></i>
                <a href="#"><i class="icon-thumbs-up"></a></i>
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
        <a href="#"><i class="icon-thumbs-up"></a></i>
      </li>
    </script>