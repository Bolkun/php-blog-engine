<?php
/**
 * @goal   get best results between echo and print
 * @return array of associative arrays
 */
function echo_vs_print()
{
    /************************************************* test 1 *********************************************************/
    // echo '';
    $start = microtime(true);
    $i = 0;
    while($i < 1000){
        echo '';
        $i++;
    }
    $result1 = microtime(true) - $start;
    unset($start);
    unset($i);
    /************************************************* test 2 *********************************************************/
    // print '';
    $start = microtime(true);
    $i = 0;
    while($i < 1000){
        print '';
        $i++;
    }
    $result2 = microtime(true) - $start;
    unset($start);
    unset($i);
    /************************************************* test 3 *********************************************************/
    // echo 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa';
    $start = microtime(true);
    $i = 0;
    while($i < 1000){
        echo '<span class="none">aaaaaaaaaaaaaaaaaaaaaaaaaaaa</span>';
        $i++;
    }
    $result3 = microtime(true) - $start;
    unset($start);
    unset($i);
    /************************************************* test 4 *********************************************************/
    // print 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa';
    $start = microtime(true);
    $i = 0;
    while($i < 1000){
        print '<span class="none">aaaaaaaaaaaaaaaaaaaaaaaaaaaa</span>';
        $i++;
    }
    $result4 = microtime(true) - $start;
    unset($start);
    unset($i);
    /************************************************* test 5 *********************************************************/
    // echo 'aaaaaaa'.'aaaaaaa'.'aaaaaaa'.'aaaaaaa';
    $start = microtime(true);
    $i = 0;
    while($i < 1000){
        echo '<span class="none">aaaaaaa'.'aaaaaaa'.'aaaaaaa'.'aaaaaaa</span>';
        $i++;
    }
    $result5 = microtime(true) - $start;
    unset($start);
    unset($i);
    /************************************************* test 6 *********************************************************/
    // print 'aaaaaaa'.'aaaaaaa'.'aaaaaaa'.'aaaaaaa';
    $start = microtime(true);
    $i = 0;
    while($i < 1000){
        print '<span class="none">aaaaaaa'.'aaaaaaa'.'aaaaaaa'.'aaaaaaa</span>';
        $i++;
    }
    $result6 = microtime(true) - $start;
    unset($start);
    unset($i);
    /************************************************* test 7 *********************************************************/
    // $a = 'aaaaaaa';
    // echo 'aaaaaaa'.$a.'aaaaaaa'.$a;
    $start = microtime(true);
    $i = 0;
    while($i < 1000){
        $a = 'aaaaaaa';
        echo '<span class="none">aaaaaaa'.$a.'aaaaaaa'.$a.'</span>';
        $i++;
    }
    $result7 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($a);
    /************************************************* test 8 *********************************************************/
    // $a = 'aaaaaaa';
    // echo 'aaaaaaa'.$a.'aaaaaaa'.$a;
    $start = microtime(true);
    $i = 0;
    while($i < 1000){
        $a = 'aaaaaaa';
        print '<span class="none">aaaaaaa'.$a.'aaaaaaa'.$a.'</span>';
        $i++;
    }
    $result8 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($a);
    /************************************************* test 9 *********************************************************/
    // $a = 'aaaaaaa';
    // echo $a.$a.$a.$a;
    $start = microtime(true);
    $i = 0;
    while($i < 1000){
        $a = 'aaaaaaa';
        echo '<span class="none">'.$a.$a.$a.$a.'</span>';
        $i++;
    }
    $result9 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($a);
    /************************************************* test 10 *********************************************************/
    // $a = 'aaaaaaa';
    // print $a.$a.$a.$a;
    $start = microtime(true);
    $i = 0;
    while($i < 1000){
        $a = 'aaaaaaa';
        print '<span class="none">'.$a.$a.$a.$a.'</span>';
        $i++;
    }
    $result10 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($a);

    //compare results and
    if($result1 > $result2) { $class1 = 'alert-danger'; $class2 = 'alert-success'; }
    elseif($result1 < $result2) { $class1 = 'alert-success'; $class2 = 'alert-danger'; }
    else { $class1 = 'alert-warning'; $class2 = 'alert-warning'; }

    if($result3 > $result4) { $class3 = 'alert-danger'; $class4 = 'alert-success'; }
    elseif($result3 < $result4) { $class3 = 'alert-success'; $class4 = 'alert-danger'; }
    else { $class3 = 'alert-warning'; $class4 = 'alert-warning'; }

    if($result5 > $result6) { $class5 = 'alert-danger'; $class6 = 'alert-success'; }
    elseif($result5 < $result6) { $class5 = 'alert-success'; $class6 = 'alert-danger'; }
    else { $class5 = 'alert-warning'; $class6 = 'alert-warning'; }

    if($result7 > $result8) { $class7 = 'alert-danger'; $class8 = 'alert-success'; }
    elseif($result7 < $result8) { $class7 = 'alert-success'; $class8 = 'alert-danger'; }
    else { $class7 = 'alert-warning'; $class8 = 'alert-warning'; }

    if($result9 > $result10) { $class9 = 'alert-danger'; $class10 = 'alert-success'; }
    elseif($result9 < $result10) { $class9 = 'alert-success'; $class10 = 'alert-danger'; }
    else { $class9 = 'alert-warning'; $class10 = 'alert-warning'; }

    return array(
        array('nr1' => 1, 'test1' => $result1, 'class1' => $class1, 'name1' => 'echo \'\';',),
        array('nr2' => 2, 'test2' => $result2, 'class2' => $class2, 'name2' => 'print \'\';',),
        array('nr3' => 3, 'test3' => $result3, 'class3' => $class3, 'name3' => 'echo \'aaaaaaaaaaaaaaaaaaaaaaaaaaaa\';',),
        array('nr4' => 4, 'test4' => $result4, 'class4' => $class4, 'name4' => 'print \'aaaaaaaaaaaaaaaaaaaaaaaaaaaa\';',),
        array('nr5' => 5, 'test5' => $result5, 'class5' => $class5, 'name5' => 'echo \'aaaaaaa\'.\'aaaaaaa\'.\'aaaaaaa\'.\'aaaaaaa\';',),
        array('nr6' => 6, 'test6' => $result6, 'class6' => $class6, 'name6' => 'print \'aaaaaaa\'.\'aaaaaaa\'.\'aaaaaaa\'.\'aaaaaaa\';',),
        array('nr7' => 7, 'test7' => $result7, 'class7' => $class7, 'name7' => '$a = \'aaaaaaa\'; <br> echo \'aaaaaaa\'.$a.\'aaaaaaa\'.$a;',),
        array('nr8' => 8, 'test8' => $result8, 'class8' => $class8, 'name8' => '$a = \'aaaaaaa\'; <br> echo \'aaaaaaa\'.$a.\'aaaaaaa\'.$a;',),
        array('nr9' => 9, 'test9' => $result9, 'class9' => $class9, 'name9' => '$a = \'aaaaaaa\'; <br> echo $a.$a.$a.$a;',),
        array('nr10' => 10, 'test10' => $result10, 'class10' => $class10, 'name10' => '$a = \'aaaaaaa\'; <br> print $a.$a.$a.$a;',),
    );
}

/**
 * @goal   get best results between single- and double quotes
 * @return array of associative arrays
 */
function single_vs_double_quotes()
{
    /************************************************* test 1 *********************************************************/
    // single (') quotes. Just an empty string: $tmp[] = '';
    $start = microtime(true);
    $i = 0;
    while($i < 1000){
        $tmp[] = '';
        $i++;
    }
    $result1 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($tmp);
    /************************************************* test 2 *********************************************************/
    // double (") quotes. Just an empty string: $tmp[] = "";
    $start = microtime(true);
    $i = 0;
    while($i < 1000){
        $tmp[] = "";
        $i++;
    }
    $result2 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($tmp);
    /************************************************* test 3 *********************************************************/
    // single (') quotes. 20 bytes Text : $tmp[] = 'aaaaaaaaaaaaaaaaaaaa';
    $start = microtime(true);
    $i = 0;
    while($i < 1000){
        $tmp[] = 'aaaaaaaaaaaaaaaaaaaa';
        $i++;
    }
    $result3 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($tmp);
    /************************************************* test 4 *********************************************************/
    // double (") quotes. 20 bytes Text : $tmp[] = "aaaaaaaaaaaaaaaaaaaa";
    $start = microtime(true);
    $i = 0;
    while($i < 1000){
        $tmp[] = "aaaaaaaaaaaaaaaaaaaa";
        $i++;
    }
    $result4 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($tmp);
    /************************************************* test 5 *********************************************************/
    // single (') quotes. 20 bytes Text and 3x a $ : $tmp[] = 'aa $ aaaa $ aaaa $ a';
    $start = microtime(true);
    $i = 0;
    while($i < 1000){
        $tmp[] = 'aa $ aaaa $ aaaa $ a';
        $i++;
    }
    $result5 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($tmp);
    /************************************************* test 6 *********************************************************/
    // double (") quotes. 20 bytes Text and 3x a $ : $tmp[] = "aa \$ aaaa \$ aaaa \$ a";
    $start = microtime(true);
    $i = 0;
    while($i < 1000){
        $tmp[] = "aa \$ aaaa \$ aaaa \$ a";
        $i++;
    }
    $result6 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($tmp);
    /************************************************* test 7 *********************************************************/
    // single (') quotes. $a = 'a'; $tmp[] = $a.' aaaa '.$a.' aaaa '.$a.' aaaa';
    $start = microtime(true);
    $i = 0;
    while($i < 1000){
        $a = 'a';
        $tmp[] = $a.' aaaa '.$a.' aaaa '.$a.' aaaa';
        $i++;
    }
    $result7 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($a);
    unset($tmp);
    /************************************************* test 8 *********************************************************/
    // double (") quotes. $a = 'a'; $tmp[] = "$a aaaa $a aaaa $a aaaa";
    $start = microtime(true);
    $i = 0;
    while($i < 1000){
        $a = "a";
        $tmp[] = "$a aaaa $a aaaa $a aaaa";
        $i++;
    }
    $result8 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($a);
    unset($tmp);

    //compare results and
    if($result1 > $result2) { $class1 = 'alert-danger'; $class2 = 'alert-success'; }
    elseif($result1 < $result2) { $class1 = 'alert-success'; $class2 = 'alert-danger'; }
    else { $class1 = 'alert-warning'; $class2 = 'alert-warning'; }

    if($result3 > $result4) { $class3 = 'alert-danger'; $class4 = 'alert-success'; }
    elseif($result3 < $result4) { $class3 = 'alert-success'; $class4 = 'alert-danger'; }
    else { $class3 = 'alert-warning'; $class4 = 'alert-warning'; }

    if($result5 > $result6) { $class5 = 'alert-danger'; $class6 = 'alert-success'; }
    elseif($result5 < $result6) { $class5 = 'alert-success'; $class6 = 'alert-danger'; }
    else { $class5 = 'alert-warning'; $class6 = 'alert-warning'; }

    if($result7 > $result8) { $class7 = 'alert-danger'; $class8 = 'alert-success'; }
    elseif($result7 < $result8) { $class7 = 'alert-success'; $class8 = 'alert-danger'; }
    else { $class7 = 'alert-warning'; $class8 = 'alert-warning'; }

    return array(
        array('nr1' => 1, 'test1' => $result1, 'class1' => $class1, 'name1' => 'single (\') quotes. Just an empty string: $tmp[] = \'\';',),
        array('nr2' => 2, 'test2' => $result2, 'class2' => $class2, 'name2' => 'double (") quotes. Just an empty string: $tmp[] = "";',),
        array('nr3' => 3, 'test3' => $result3, 'class3' => $class3, 'name3' => 'single (\') quotes. 20 bytes Text : $tmp[] = \'aaaaaaaaaaaaaaaaaaaa\';',),
        array('nr4' => 4, 'test4' => $result4, 'class4' => $class4, 'name4' => 'double (") quotes. 20 bytes Text : $tmp[] = "aaaaaaaaaaaaaaaaaaaa";',),
        array('nr5' => 5, 'test5' => $result5, 'class5' => $class5, 'name5' => 'single (\') quotes. 20 bytes Text and 3x a $ : $tmp[] = \'aa $ aaaa $ aaaa $ a\';',),
        array('nr6' => 6, 'test6' => $result6, 'class6' => $class6, 'name6' => 'double (") quotes. 20 bytes Text and 3x a $ : $tmp[] = "aa \$ aaaa \$ aaaa \$ a";',),
        array('nr7' => 7, 'test7' => $result7, 'class7' => $class7, 'name7' => 'single (\') quotes. $a = \'a\'; $tmp[] = $a.\' aaaa \'.$a.\' aaaa \'.$a.\' aaaa\';',),
        array('nr8' => 8, 'test8' => $result8, 'class8' => $class8, 'name8' => 'double (") quotes. $a = \'a\'; $tmp[] = "$a aaaa $a aaaa $a aaaa";',),
    );
}

/**
 * @goal   get best results between if and switch
 * @return array of associative arrays
 */
function if_vs_switch()
{
    /************************************************* test 1 *********************************************************/
    // if and elseif (using ==)
    $start = microtime(true);
    $i = 0;
    $a = 2;
    while($i < 1000){
        if($a == 1){

        } else if($a == 2){

        }
        $i++;
    }
    $result1 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($a);
    /************************************************* test 2 *********************************************************/
    // switch / case
    $start = microtime(true);
    $i = 0;
    $a = 2;
    while($i < 1000){
        switch($a){
            case 1:

                break;

            case 2:

                break;
        }
        $i++;
    }
    $result2 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($a);
    /************************************************* test 3 *********************************************************/
    // if, elseif and else (using ==)
    $start = microtime(true);
    $i = 0;
    $a = 3;
    while($i < 1000){
        if($a == 1){

        } else if($a == 2){

        } else {

        }
        $i++;
    }
    $result3 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($a);
    /************************************************* test 4 *********************************************************/
    // switch / case / default
    $start = microtime(true);
    $i = 0;
    $a = 3;
    while($i < 1000){
        switch($a){
            case 1:

                break;

            case 2:

                break;
            default:

                break;
        }
        $i++;
    }
    $result4 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($a);
    /************************************************* test 5 *********************************************************/
    // if and elseif (using ===)
    $start = microtime(true);
    $i = 0;
    $a = 2;
    while($i < 1000){
        if($a === 1){

        } else if($a === 2){

        }
        $i++;
    }
    $result5 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($a);
    /************************************************* test 6 *********************************************************/
    // switch / case
    $start = microtime(true);
    $i = 0;
    $a = 2;
    while($i < 1000){
        switch($a){
            case 1:

                break;

            case 2:

                break;
        }
        $i++;
    }
    $result6 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($a);
    /************************************************* test 7 *********************************************************/
    // if, elseif and else (using ===)
    $start = microtime(true);
    $i = 0;
    $a = 3;
    while($i < 1000){
        if($a === 1){

        } else if($a === 2){

        } else {

        }
        $i++;
    }
    $result7 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($a);
    /************************************************* test 8 *********************************************************/
    // switch / case / default
    $start = microtime(true);
    $i = 0;
    $a = 3;
    while($i < 1000){
        switch($a){
            case 1:

                break;

            case 2:

                break;
            default:

                break;
        }
        $i++;
    }
    $result8 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($a);

    //compare results and
    if($result1 > $result2) { $class1 = 'alert-danger'; $class2 = 'alert-success'; }
    elseif($result1 < $result2) { $class1 = 'alert-success'; $class2 = 'alert-danger'; }
    else { $class1 = 'alert-warning'; $class2 = 'alert-warning'; }

    if($result3 > $result4) { $class3 = 'alert-danger'; $class4 = 'alert-success'; }
    elseif($result3 < $result4) { $class3 = 'alert-success'; $class4 = 'alert-danger'; }
    else { $class3 = 'alert-warning'; $class4 = 'alert-warning'; }

    if($result5 > $result6) { $class5 = 'alert-danger'; $class6 = 'alert-success'; }
    elseif($result5 < $result6) { $class5 = 'alert-success'; $class6 = 'alert-danger'; }
    else { $class5 = 'alert-warning'; $class6 = 'alert-warning'; }

    if($result7 > $result8) { $class7 = 'alert-danger'; $class8 = 'alert-success'; }
    elseif($result7 < $result8) { $class7 = 'alert-success'; $class8 = 'alert-danger'; }
    else { $class7 = 'alert-warning'; $class8 = 'alert-warning'; }

    return array(
        array('nr1' => 1, 'test1' => $result1, 'class1' => $class1, 'name1' => 'if and elseif (using ==)',),
        array('nr2' => 2, 'test2' => $result2, 'class2' => $class2, 'name2' => 'switch / case',),
        array('nr3' => 3, 'test3' => $result3, 'class3' => $class3, 'name3' => 'if, elseif and else (using ==)',),
        array('nr4' => 4, 'test4' => $result4, 'class4' => $class4, 'name4' => 'switch / case / default',),
        array('nr5' => 5, 'test5' => $result5, 'class5' => $class5, 'name5' => 'if and elseif (using ===)',),
        array('nr6' => 6, 'test6' => $result6, 'class6' => $class6, 'name6' => 'switch / case',),
        array('nr7' => 7, 'test7' => $result7, 'class7' => $class7, 'name7' => 'if, elseif and else (using ===)',),
        array('nr8' => 8, 'test8' => $result8, 'class8' => $class8, 'name8' => 'switch / case / default',),
    );
}

/**
 * @goal   get best results between counting for and while
 * @return array of associative arrays
 */
function for_vs_while_counting()
{
    /************************************************* test 1 *********************************************************/
    // for($i = 0; $i < 1000; $i++);
    $start = microtime(true);
    for($i = 0; $i < 1000; $i++);
    $result1 = microtime(true) - $start;
    unset($start);
    unset($i);
    /************************************************* test 2 *********************************************************/
    // $i = 0; while($i < 1000) $i++;
    $start = microtime(true);
    $i = 0; while($i < 1000) $i++;
    $result2 = microtime(true) - $start;
    unset($start);
    unset($i);

    //compare results and
    if($result1 > $result2) { $class1 = 'alert-danger'; $class2 = 'alert-success'; }
    elseif($result1 < $result2) { $class1 = 'alert-success'; $class2 = 'alert-danger'; }
    else { $class1 = 'alert-warning'; $class2 = 'alert-warning'; }

    return array(
        array('nr1' => 1, 'test1' => $result1, 'class1' => $class1, 'name1' => 'for($i = 0; $i < 1000; $i++);',),
        array('nr2' => 2, 'test2' => $result2, 'class2' => $class2, 'name2' => '$i = 0; while($i < 1000) $i++;',),
    );
}

/**
 * @goal   get best results printing associative array between foreach and for, while is deprecated
 * @return array of associative arrays
 */
function readAssocArray_foreach_vs_for()
{
    /************************************************* test 1 *********************************************************/
    // foreach($aHash as $key => $val);
    $i = 0;
    $tmp = '';
    $aHash = array();
    while($i < 1000) {
        $tmp .= 'a';
        $aHash[$tmp] = $i;
        $i++;
    }

    $start = microtime(true);
    foreach($aHash as $key => $val){
        echo '<span class="none">'.$key . '=' . $val . '</span>';
    }
    $result1 = microtime(true) - $start;
    unset($i);
    unset($tmp);
    unset($aHash);
    unset($start);
    /************************************************* test 2 *********************************************************/
    // $size = count($aHash);
    // $keys = array_keys($aHash);
    // for($i=0; $i<$size; $i++);
    $i = 0;
    $tmp = '';
    $aHash = array();
    while($i < 1000) {
        $tmp .= 'a';
        $aHash[$tmp] = $i;
        $i++;
    }
    unset($i);

    $start = microtime(true);
    $size = count($aHash);
    $keys = array_keys($aHash);
    for($i=0; $i<$size; $i++){
        echo '<span class="none">'.$keys[$i] . '=' . $aHash[$keys[$i]] . '</span>';
    }
    $result2 = microtime(true) - $start;
    unset($i);
    unset($tmp);
    unset($aHash);
    unset($start);
    unset($size);
    unset($keys);

    //compare results and
    if($result1 > $result2) { $class1 = 'alert-danger'; $class2 = 'alert-success'; }
    elseif($result1 < $result2) { $class1 = 'alert-success'; $class2 = 'alert-danger'; }
    else { $class1 = 'alert-warning'; $class2 = 'alert-warning'; }

    return array(
        array('nr1' => 1, 'test1' => $result1, 'class1' => $class1, 'name1' => 'foreach($aHash as $key => $val);',),
        array('nr2' => 2, 'test2' => $result2, 'class2' => $class2, 'name2' => '$size = count($aHash); <br> $keys = array_keys($aHash); <br> for($i=0; $i<$size; $i++);',),
    );
}

/**
 * @goal   get best results writing new associative array with for and while
 * @return array of associative arrays
 */
function writeAssocArray_for_vs_while()
{
    /************************************************* test 1 *********************************************************/
    // for($i=0; $i<1000; $i++);
    $start = microtime(true);
    $tmp = '';
    $aHash = array();
    for($i=0; $i<1000; $i++) {
        $tmp .= 'a';
        $aHash[$tmp] = $i;
        $i++;
    }
    $result1 = microtime(true) - $start;
    unset($start);
    unset($tmp);
    unset($aHash);
    unset($i);
    /************************************************* test 2 *********************************************************/
    // while($i < 1000);
    $start = microtime(true);
    $i = 0;
    $tmp = '';
    $aHash = array();
    while($i < 1000) {
        $tmp .= 'a';
        $aHash[$tmp] = $i;
        $i++;
    }
    $result2 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($tmp);
    unset($aHash);

    //compare results and
    if($result1 > $result2) { $class1 = 'alert-danger'; $class2 = 'alert-success'; }
    elseif($result1 < $result2) { $class1 = 'alert-success'; $class2 = 'alert-danger'; }
    else { $class1 = 'alert-warning'; $class2 = 'alert-warning'; }

    return array(
        array('nr1' => 1, 'test1' => $result1, 'class1' => $class1, 'name1' => 'for($i=0; $i<1000; $i++);',),
        array('nr2' => 2, 'test2' => $result2, 'class2' => $class2, 'name2' => 'while($i < 1000);',),
    );
}

/**
 * @goal   get best results modifying associative array between foreach and for, while is deprecated
 * @return array of associative arrays
 */
function modifyAssocArray_foreach_vs_for()
{
    /************************************************* test 1 *********************************************************/
    // foreach($aHash as $key=>$val) $aHash[$key] .= "a";
    $i = 0;
    $tmp = '';
    $aHash = array();
    while($i < 1000) {
        $tmp .= 'a';
        $aHash[$tmp] = $i;
        $i++;
    }

    $start = microtime(true);
    foreach($aHash as $key => $val){
        $aHash[$key] .= "a";
    }
    $result1 = microtime(true) - $start;
    unset($i);
    unset($tmp);
    unset($aHash);
    unset($start);
    /************************************************* test 2 *********************************************************/
    // $size = count($aHash);
    // $keys = array_keys($aHash);
    // for($i=0; $i<$size; $i++);
    $i = 0;
    $tmp = '';
    $aHash = array();
    while($i < 1000) {
        $tmp .= 'a';
        $aHash[$tmp] = $i;
        $i++;
    }
    unset($i);

    $start = microtime(true);
    $size = count($aHash);
    $keys = array_keys($aHash);
    for($i=0; $i<$size; $i++){
        $aHash[$keys[$i]] .= "a";
    }
    $result2 = microtime(true) - $start;
    unset($i);
    unset($tmp);
    unset($aHash);
    unset($start);
    unset($size);
    unset($keys);

    //compare results and
    if($result1 > $result2) { $class1 = 'alert-danger'; $class2 = 'alert-success'; }
    elseif($result1 < $result2) { $class1 = 'alert-success'; $class2 = 'alert-danger'; }
    else { $class1 = 'alert-warning'; $class2 = 'alert-warning'; }

    return array(
        array('nr1' => 1, 'test1' => $result1, 'class1' => $class1, 'name1' => 'foreach($aHash as $key=>$val) $aHash[$key] .= "a";',),
        array('nr2' => 2, 'test2' => $result2, 'class2' => $class2, 'name2' => '$size = count($aHash); <br> $keys = array_keys($aHash); <br> for($i=0; $i<$size; $i++);',),
    );
}
