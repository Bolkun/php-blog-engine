<div class="container">
    <div class="row">
        <?php
            $x = 5985;
            $s = "word";
            $f = 2.56;
            $b = true;
            $a = array();
            $n = NULL;
            $o = new stdClass(); $o->property = "Here we go";
            //$r = (resource) $a(var);

            printVarType($x);
            printVarType($s);
            printVarType($f);
            printVarType($b);
            printVarType($a);
            printVarType($n);
            printVarType($o);
            //printVarType($r);
        ?>
    </div>
</div>