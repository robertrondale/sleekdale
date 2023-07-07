<?php
if (function_exists('icl_get_languages')) {

	# Get all languages
	$langs = icl_get_languages('skip_missing=0&orderby=code');

	# Add "code" (polylang uses language_code)
	$langs = array_map(function ($lang) {
		$lang['code'] = $lang['code'] ?? $lang['language_code'];
		$lang['code'] = strtoupper($lang['code']);

		return $lang;
	}, $langs);

	# Grab active lang
	$currLang = array_filter($langs, function ($lang) {
		return $lang['active'];
	});

	$currLang = array_values($currLang); # Strip keys
	$currLang = array_shift($currLang); # Fetch first element

} else {

	$currLang = [
		'code' => 'EN',
		'native_name' => 'English'
	];

	$langs = [
		[
			'code' => 'EN',
			'url' => '#',
			'native_name' => 'English'
		],
		[
			'code' => 'SV',
			'url' => '#',
			'native_name' => 'Svenska'
		],
	];
}
?>

<?php if ($langs) : ?>
<ul class="nav-language">
	<?php foreach ($langs as $lang) : ?>
	<li class="nav-language-item">
		<a class="nav-language-link link-with-underline-animation <?php echo $currLang['code'] === $lang['code'] ? ' is-active' : '' ?>"
			href="<?php echo $lang['url'] ?>">
			<?php echo $lang['code'] ?>
		</a>
	</li>
	<?php endforeach ?>
</ul>
<?php endif ?>