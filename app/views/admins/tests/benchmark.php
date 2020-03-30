<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div id="wrapper">
                        <h1><?php echo $data['title']; ?></h1>
                        <div id="viewsAdminsTestsBenchmark">
                            <div class="table-responsive">
                                <h2>String Output: echo vs. print</h2>
                                <table class="table benchmark">
                                    <tbody>
                                         <tr class="<?php echo $data['stringOutputs']['class1']; ?>">
                                             <td><?php echo $data['stringOutputs']['nr1']; ?></td>
                                             <td>echo '';</td>
                                             <td><?php echo $data['stringOutputs']['test1'] . ' ms'; ?></td>
                                         </tr>
                                         <tr class="<?php echo $data['stringOutputs']['class2']; ?>">
                                             <td><?php echo $data['stringOutputs']['nr2']; ?></td>
                                             <td>print '';</td>
                                             <td><?php echo $data['stringOutputs']['test2'] . ' ms'; ?></td>
                                         </tr>
                                         <tr class="<?php echo $data['stringOutputs']['class3']; ?>">
                                             <td><?php echo $data['stringOutputs']['nr3']; ?></td>
                                             <td>echo 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa';</td>
                                             <td><?php echo $data['stringOutputs']['test3'] . ' ms'; ?></td>
                                         </tr>
                                         <tr class="<?php echo $data['stringOutputs']['class4']; ?>">
                                             <td><?php echo $data['stringOutputs']['nr4']; ?></td>
                                             <td>print 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa';</td>
                                             <td><?php echo $data['stringOutputs']['test4'] . ' ms'; ?></td>
                                         </tr>
                                         <tr class="<?php echo $data['stringOutputs']['class5']; ?>">
                                             <td><?php echo $data['stringOutputs']['nr5']; ?></td>
                                             <td>echo 'aaaaaaa'.'aaaaaaa'.'aaaaaaa'.'aaaaaaa';</td>
                                             <td><?php echo $data['stringOutputs']['test5'] . ' ms'; ?></td>
                                         </tr>
                                         <tr class="<?php echo $data['stringOutputs']['class6']; ?>">
                                             <td><?php echo $data['stringOutputs']['nr6']; ?></td>
                                             <td>print 'aaaaaaa'.'aaaaaaa'.'aaaaaaa'.'aaaaaaa';</td>
                                             <td><?php echo $data['stringOutputs']['test6'] . ' ms'; ?></td>
                                         </tr>
                                         <tr class="<?php echo $data['stringOutputs']['class7']; ?>">
                                             <td><?php echo $data['stringOutputs']['nr7']; ?></td>
                                             <td>$a = 'aaaaaaa'; echo 'aaaaaaa'.$a.'aaaaaaa'.$a;</td>
                                             <td><?php echo $data['stringOutputs']['test7'] . ' ms'; ?></td>
                                         </tr>
                                         <tr class="<?php echo $data['stringOutputs']['class8']; ?>">
                                             <td><?php echo $data['stringOutputs']['nr8']; ?></td>
                                             <td>$a = 'aaaaaaa'; echo 'aaaaaaa'.$a.'aaaaaaa'.$a;</td>
                                             <td><?php echo $data['stringOutputs']['test8'] . ' ms'; ?></td>
                                         </tr>
                                         <tr class="<?php echo $data['stringOutputs']['class9']; ?>">
                                             <td><?php echo $data['stringOutputs']['nr9']; ?></td>
                                             <td>$a = 'aaaaaaa'; echo $a.$a.$a.$a;</td>
                                             <td><?php echo $data['stringOutputs']['test9'] . ' ms'; ?></td>
                                         </tr>
                                         <tr class="<?php echo $data['stringOutputs']['class10']; ?>">
                                             <td><?php echo $data['stringOutputs']['nr10']; ?></td>
                                             <td>$a = 'aaaaaaa'; print $a.$a.$a.$a;</td>
                                             <td><?php echo $data['stringOutputs']['test10'] . ' ms'; ?></td>
                                         </tr>
                                    </tbody>
                                </table>
                                <h2>Quote Types: double(") vs. single(') quotes</h2>
                                <table class="table benchmark">
                                    <tbody>
                                    <tr class="<?php echo $data['quotes']['class1']; ?>">
                                        <td><?php echo $data['quotes']['nr1']; ?></td>
                                        <td>single (') quotes. Just an empty string: $tmp[] = '';</td>
                                        <td><?php echo $data['quotes']['test1'] . ' ms'; ?></td>
                                    </tr>
                                    <tr class="<?php echo $data['quotes']['class2']; ?>">
                                        <td><?php echo $data['quotes']['nr2']; ?></td>
                                        <td>double (") quotes. Just an empty string: $tmp[] = "";</td>
                                        <td><?php echo $data['quotes']['test2'] . ' ms'; ?></td>
                                    </tr>
                                    <tr class="<?php echo $data['quotes']['class3']; ?>">
                                        <td><?php echo $data['quotes']['nr3']; ?></td>
                                        <td>single (') quotes. 20 bytes Text : $tmp[] = 'aaaaaaaaaaaaaaaaaaaa';</td>
                                        <td><?php echo $data['quotes']['test3'] . ' ms'; ?></td>
                                    </tr>
                                    <tr class="<?php echo $data['quotes']['class4']; ?>">
                                        <td><?php echo $data['quotes']['nr4']; ?></td>
                                        <td>double (") quotes. 20 bytes Text : $tmp[] = "aaaaaaaaaaaaaaaaaaaa";</td>
                                        <td><?php echo $data['quotes']['test4'] . ' ms'; ?></td>
                                    </tr>
                                    <tr class="<?php echo $data['quotes']['class5']; ?>">
                                        <td><?php echo $data['quotes']['nr5']; ?></td>
                                        <td>single (') quotes. 20 bytes Text and 3x a $ : $tmp[] = 'aa $ aaaa $ aaaa $ a';</td>
                                        <td><?php echo $data['quotes']['test5'] . ' ms'; ?></td>
                                    </tr>
                                    <tr class="<?php echo $data['quotes']['class6']; ?>">
                                        <td><?php echo $data['quotes']['nr6']; ?></td>
                                        <td>double (") quotes. 20 bytes Text and 3x a $ : $tmp[] = "aa \$ aaaa \$ aaaa \$ a";</td>
                                        <td><?php echo $data['quotes']['test6'] . ' ms'; ?></td>
                                    </tr>
                                    <tr class="<?php echo $data['quotes']['class7']; ?>">
                                        <td><?php echo $data['quotes']['nr7']; ?></td>
                                        <td>single (') quotes. $a = 'a'; $tmp[] = $a.' aaaa '.$a.' aaaa '.$a.' aaaa';</td>
                                        <td><?php echo $data['quotes']['test7'] . ' ms'; ?></td>
                                    </tr>
                                    <tr class="<?php echo $data['quotes']['class8']; ?>">
                                        <td><?php echo $data['quotes']['nr8']; ?></td>
                                        <td>double (") quotes. $a = 'a'; $tmp[] = "$a aaaa $a aaaa $a aaaa";</td>
                                        <td><?php echo $data['quotes']['test8'] . ' ms'; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h2>Control Structures: if vs. switch</h2>
                                <table class="table benchmark">
                                    <tbody>
                                    <tr class="<?php echo $data['conditions']['class1']; ?>">
                                        <td><?php echo $data['conditions']['nr1']; ?></td>
                                        <td>if and elseif (using ==)</td>
                                        <td><?php echo $data['conditions']['test1'] . ' ms'; ?></td>
                                    </tr>
                                    <tr class="<?php echo $data['conditions']['class2']; ?>">
                                        <td><?php echo $data['conditions']['nr2']; ?></td>
                                        <td>switch / case</td>
                                        <td><?php echo $data['conditions']['test2'] . ' ms'; ?></td>
                                    </tr>
                                    <tr class="<?php echo $data['conditions']['class3']; ?>">
                                        <td><?php echo $data['conditions']['nr3']; ?></td>
                                        <td>if, elseif and else (using ==)</td>
                                        <td><?php echo $data['conditions']['test3'] . ' ms'; ?></td>
                                    </tr>
                                    <tr class="<?php echo $data['conditions']['class4']; ?>">
                                        <td><?php echo $data['conditions']['nr4']; ?></td>
                                        <td>switch / case / default</td>
                                        <td><?php echo $data['conditions']['test4'] . ' ms'; ?></td>
                                    </tr>
                                    <tr class="<?php echo $data['conditions']['class5']; ?>">
                                        <td><?php echo $data['conditions']['nr5']; ?></td>
                                        <td>if and elseif (using ===)</td>
                                        <td><?php echo $data['conditions']['test5'] . ' ms'; ?></td>
                                    </tr>
                                    <tr class="<?php echo $data['conditions']['class6']; ?>">
                                        <td><?php echo $data['conditions']['nr6']; ?></td>
                                        <td>switch / case</td>
                                        <td><?php echo $data['conditions']['test6'] . ' ms'; ?></td>
                                    </tr>
                                    <tr class="<?php echo $data['conditions']['class7']; ?>">
                                        <td><?php echo $data['conditions']['nr7']; ?></td>
                                        <td>if, elseif and else (using ===)</td>
                                        <td><?php echo $data['conditions']['test7'] . ' ms'; ?></td>
                                    </tr>
                                    <tr class="<?php echo $data['conditions']['class8']; ?>">
                                        <td><?php echo $data['conditions']['nr8']; ?></td>
                                        <td>switch / case / default</td>
                                        <td><?php echo $data['conditions']['test8'] . ' ms'; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h2>Counting Loop: for() vs. while()</h2>
                                <table class="table benchmark">
                                    <tbody>
                                    <tr class="<?php echo $data['countingLoops']['class1']; ?>">
                                        <td><?php echo $data['countingLoops']['nr1']; ?></td>
                                        <td>for($i = 0; $i < 1000; $i++);</td>
                                        <td><?php echo $data['countingLoops']['test1'] . ' ms'; ?></td>
                                    </tr>
                                    <tr class="<?php echo $data['countingLoops']['class2']; ?>">
                                        <td><?php echo $data['countingLoops']['nr2']; ?></td>
                                        <td>$i = 0; while($i < 1000) $i++;</td>
                                        <td><?php echo $data['countingLoops']['test2'] . ' ms'; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h2>Read Loop: foreach() vs. for()</h2>
                                <table class="table benchmark">
                                    <tbody>
                                    <tr class="<?php echo $data['readLoop']['class1']; ?>">
                                        <td><?php echo $data['readLoop']['nr1']; ?></td>
                                        <td>foreach($aHash as $key => $val);</td>
                                        <td><?php echo $data['readLoop']['test1'] . ' ms'; ?></td>
                                    </tr>
                                    <tr class="<?php echo $data['readLoop']['class2']; ?>">
                                        <td><?php echo $data['readLoop']['nr2']; ?></td>
                                        <td>$size = count($aHash); $keys = array_keys($aHash); for($i=0; $i<$size; $i++);</td>
                                        <td><?php echo $data['readLoop']['test2'] . ' ms'; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h2>Write Loop: for() vs. while()</h2>
                                <table class="table benchmark">
                                    <tbody>
                                    <tr class="<?php echo $data['writeLoop']['class1']; ?>">
                                        <td><?php echo $data['writeLoop']['nr1']; ?></td>
                                        <td>for($i=0; $i<1000; $i++);</td>
                                        <td><?php echo $data['writeLoop']['test1'] . ' ms'; ?></td>
                                    </tr>
                                    <tr class="<?php echo $data['writeLoop']['class2']; ?>">
                                        <td><?php echo $data['writeLoop']['nr2']; ?></td>
                                        <td>while($i < 1000);</td>
                                        <td><?php echo $data['writeLoop']['test2'] . ' ms'; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h2>Modify Loop: foreach() vs. for()</h2>
                                <table class="table benchmark">
                                    <tbody>
                                    <tr class="<?php echo $data['modifyLoop']['class1']; ?>">
                                        <td><?php echo $data['modifyLoop']['nr1']; ?></td>
                                        <td>foreach($aHash as $key=>$val) $aHash[$key] .= "a";</td>
                                        <td><?php echo $data['modifyLoop']['test1'] . ' ms'; ?></td>
                                    </tr>
                                    <tr class="<?php echo $data['modifyLoop']['class2']; ?>">
                                        <td><?php echo $data['modifyLoop']['nr2']; ?></td>
                                        <td>$size = count($aHash); $keys = array_keys($aHash); for($i=0; $i<$size; $i++);</td>
                                        <td><?php echo $data['modifyLoop']['test2'] . ' ms'; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
