<?php 
// var_dump($parents);die;
foreach ($parents as $menu) : ?>
    <div class="form-group" style="padding-left: <?= intval($menu['level']) * 20 ?>px">
        <label>
            <input type="checkbox" name="menus[]" value="<?= $menu['id'] ?>" class="minimal" <?= $menu['show'] ? "checked" : "" ?>>
        </label>
        <label style="padding-left: 10px"> <?= $menu['name'] ?></label>
        <?php if ($menu['children']) : ?>
            <?= $this->render('_partial_recursive', [
                'parents' => $menu['children'],
            ]) ?>
        <?php elseif ($menu['actions']) : ?>
            <?= $this->render('_partial_action', ['actions' => $menu['actions']]) ?>
        <?php endif; ?>
    </div>
<?php endforeach; ?>