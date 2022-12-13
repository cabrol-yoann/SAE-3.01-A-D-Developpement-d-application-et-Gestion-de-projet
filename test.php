
<?php
$s = new SplObjectStorage();

$o1 = new StdClass;
$o2 = new StdClass;

$s->attach($o1, "d1");
$s->attach($o2, "d2");

$s->rewind();
while($s->valid()) {
    $index = $s->key();
    $object = $s->current(); // similaire à current($s)

    var_dump($index);
    var_dump($object);
    $s->next();
}
?>
