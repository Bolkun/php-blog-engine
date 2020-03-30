<?php
// count() vs sizeof() = WINNER count!!!
// empty() vs isset()  = almost identical, but WINNER empty(), because sometimes 1 ms faster

/**
 * @goal   get best results between echo and print
 * @return array (associative)
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
        echo 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa';
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
        print 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa';
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
        echo 'aaaaaaa'.'aaaaaaa'.'aaaaaaa'.'aaaaaaa';
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
        print 'aaaaaaa'.'aaaaaaa'.'aaaaaaa'.'aaaaaaa';
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
        echo 'aaaaaaa'.$a.'aaaaaaa'.$a;
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
        print 'aaaaaaa'.$a.'aaaaaaa'.$a;
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
        echo $a.$a.$a.$a;
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
        print $a.$a.$a.$a;
        $i++;
    }
    $result10 = microtime(true) - $start;
    unset($start);
    unset($i);
    unset($a);

    return array('test1' => $result1, 'test2' => $result2, 'test3' => $result3, 'test4' => $result4,
                 'test5' => $result5, 'test6' => $result6, 'test7' => $result7, 'test8' => $result8,
                 'test9' => $result9, 'test10' => $result10);
}

/**
 * @goal   get best results between single- and double quotes
 * @return array (associative)
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

    return array('test1' => $result1, 'test2' => $result2, 'test3' => $result3, 'test4' => $result4,
        'test5' => $result5, 'test6' => $result6, 'test7' => $result7, 'test8' => $result8);
}

/**
 * @goal   get best results between if and switch
 * @return array (associative)
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

    return array('test1' => $result1, 'test2' => $result2, 'test3' => $result3, 'test4' => $result4,
        'test5' => $result5, 'test6' => $result6, 'test7' => $result7, 'test8' => $result8);
}

/**
 * @goal   get best results between counting for and while
 * @return array (associative)
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

    return array('test1' => $result1, 'test2' => $result2);
}

/**
 * @goal   get best results printing associative array between foreach and for, while is deprecated
 * @return array (associative)
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
        echo $key . '=' . $val . '\n';
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
        echo $keys[$i] . '=' . $aHash[$keys[$i]] . '\n';
    }
    $result2 = microtime(true) - $start;
    unset($i);
    unset($tmp);
    unset($aHash);
    unset($start);
    unset($size);
    unset($keys);

    return array('test1' => $result1, 'test2' => $result2);
}

/**
 * @goal   get best results writing new associative array with for and while
 * @return array (associative)
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

    return array('test1' => $result1, 'test2' => $result2);
}

/**
 * @goal   get best results modifying associative array between foreach and for, while is deprecated
 * @return array (associative)
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

    return array('test1' => $result1, 'test2' => $result2);
}
