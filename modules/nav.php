<?php

use Inc\Classes\Navigation;

$menus = [];

# convert $menu_names to array if passed value is a string 
if (is_string($menu_names)) {
    $menu_names = [$menu_names];
}

# combined all menus
if (is_array($menu_names) && sizeof($menu_names) > 0) {
    foreach ($menu_names as $menu_name) {

        # get the menu id based on menu name
        $menuId = Navigation::getMenuId($menu_name);

        # get the menu list
        $tempMenus = Navigation::getMenu($menuId);

        # append current menu to menu collection
        if (!empty($tempMenus)) {
            $menus = array_merge($menus, $tempMenus);
        }
    }
}
?>

<?php if ($menus) : ?>
<ul class="<?= $menu_class ?>">
	<?php foreach ($menus as $menuKey => $menu) : ?>
	<?php if (isset($menu->children) && $menu->children) : ?>

	<?php
                $itemClass = '';
                $itemAttr = '';
                $itemId = "submenu-$menuKey";

                if ($has_toggle ?? '') {
                    $itemId = "submenu-toggle-$menuKey";
                    $itemClass = ' js-submenu-toggle';
                    $itemAttr = " data-toggle='$itemId'";
                }
                ?>

	<li class="nav-link with-submenu">
		<div class="submenu-parent <?= $itemClass ?>" <?= $itemAttr ?>>
			<a class="<?= $item_link_class ?> " href="<?= $menu->url ?>"
				target="<?= $menu->target ?>"><?= $menu->title ?></a>
			<div class="submenu-toggle">
				<svg width="13" height="10" viewBox="0 0 13 10" fill="none" xmlns="http://www.w3.org/2000/svg">
					<g clip-path="url(#clip0_1467_12047)">
						<path d="M12 1.65674L6.5 7.65674L1 1.65674" stroke="#E1EFEB" stroke-width="2" />
					</g>
					<defs>
						<clipPath id="clip0_1467_12047">
							<rect width="9" height="13" fill="white" transform="translate(13 0.656738) rotate(90)" />
						</clipPath>
					</defs>
				</svg>
			</div>
		</div>
		<div class="submenu" id="<?= $itemId ?>">
			<ul class="submenu-inner">
				<?php foreach ($menu->children as $subMenu) : ?>
				<li class="submenu-item"><a class="submenu-link" href="<?= $subMenu->url ?>"
						target="<?= $subMenu->target ?>"><?= $subMenu->title ?></a></li>
				<?php endforeach ?>
			</ul>
		</div>
	</li>
	<?php else : ?>
	<li class="nav-link"><a class="<?= $item_link_class ?>" href="<?= $menu->url ?>"
			target="<?= $menu->target ?>"><?= $menu->title ?></a></li>
	<?php endif ?>
	<?php endforeach ?>
</ul>
<?php endif ?>