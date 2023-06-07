<form method="post" enctype="multipart/form-data">
  <div>
    <input type="file" name="excel">
    <input type="hidden" name="_csrfToken" autocomplete="off" value="<?= $this->request->getAttribute('csrfToken') ?>">
    <button type="submit">アップロード</button>
  </div>
</form>