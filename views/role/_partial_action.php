<div class="form-group" style="padding-left: <?= ($level * 20 + 10)  ?>px;">
    <label>
        <input type="checkbox" class="minimal select-all">
    </label>
    <label style="padding: 0px 20px 0px 5px"> Select All</label>
    <?php foreach ($actions as $action) : ?>
        <label>
            <input type="checkbox" name="actions[]" value="<?= $action['id'] ?>" class="minimal actions" <?= $action['has_access'] ? "checked" : ""  ?>>
        </label>
        <label style="padding: 0px 20px 0px 5px"> <?= $action['name'] ?></label>
    <?php endforeach ?>
</div>