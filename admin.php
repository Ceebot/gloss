<? require_once 'php/header.php' ?>

<?
$string = 'залупа';
$mass = [1, 5, 6, 3, 6, 7, 8, 6];
echo vueTag('vue-acc', [
    'text' => $mass,
    'string' => $string,
]);
?>

<a href="php/exit.php">Выйти</a>

<? require_once 'php/footer.php' ?>
