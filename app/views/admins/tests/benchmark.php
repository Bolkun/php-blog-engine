<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div id="wrapper">
                        <h1><?php echo $data['title']; ?></h1>
                        <div id="viewsAdminsTestsBenchmark">
                            <div class="table-responsive">
                                <h2>String Output echo vs. print</h2>
                                <table class="table benchmark">
                                    <tbody>
                                         <tr <?php if($data['stringOutputs']['test1'] > $data['stringOutputs']['test2']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                             <td>echo '';</td>
                                             <td><?php echo $data['stringOutputs']['test1'] . ' ms'; ?></td>
                                         </tr>
                                         <tr <?php if($data['stringOutputs']['test1'] < $data['stringOutputs']['test2']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                             <td>print '';</td>
                                             <td><?php echo $data['stringOutputs']['test2'] . ' ms'; ?></td>
                                         </tr>
                                         <tr <?php if($data['stringOutputs']['test3'] > $data['stringOutputs']['test4']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                             <td>echo 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa';</td>
                                             <td><?php echo $data['stringOutputs']['test3'] . ' ms'; ?></td>
                                         </tr>
                                         <tr <?php if($data['stringOutputs']['test3'] < $data['stringOutputs']['test4']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                             <td>print 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa';</td>
                                             <td><?php echo $data['stringOutputs']['test4'] . ' ms'; ?></td>
                                         </tr>
                                         <tr <?php if($data['stringOutputs']['test5'] > $data['stringOutputs']['test6']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                             <td>echo 'aaaaaaa'.'aaaaaaa'.'aaaaaaa'.'aaaaaaa';</td>
                                             <td><?php echo $data['stringOutputs']['test5'] . ' ms'; ?></td>
                                         </tr>
                                         <tr <?php if($data['stringOutputs']['test5'] < $data['stringOutputs']['test6']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                             <td>print 'aaaaaaa'.'aaaaaaa'.'aaaaaaa'.'aaaaaaa';</td>
                                             <td><?php echo $data['stringOutputs']['test6'] . ' ms'; ?></td>
                                         </tr>
                                         <tr <?php if($data['stringOutputs']['test7'] > $data['stringOutputs']['test8']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                             <td>$a = 'aaaaaaa'; echo 'aaaaaaa'.$a.'aaaaaaa'.$a;</td>
                                             <td><?php echo $data['stringOutputs']['test7'] . ' ms'; ?></td>
                                         </tr>
                                         <tr <?php if($data['stringOutputs']['test7'] < $data['stringOutputs']['test8']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                             <td>$a = 'aaaaaaa'; echo 'aaaaaaa'.$a.'aaaaaaa'.$a;</td>
                                             <td><?php echo $data['stringOutputs']['test8'] . ' ms'; ?></td>
                                         </tr>
                                         <tr <?php if($data['stringOutputs']['test9'] > $data['stringOutputs']['test10']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                             <td>$a = 'aaaaaaa'; echo $a.$a.$a.$a;</td>
                                             <td><?php echo $data['stringOutputs']['test9'] . ' ms'; ?></td>
                                         </tr>
                                         <tr <?php if($data['stringOutputs']['test9'] < $data['stringOutputs']['test10']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                             <td>$a = 'aaaaaaa'; print $a.$a.$a.$a;</td>
                                             <td><?php echo $data['stringOutputs']['test10'] . ' ms'; ?></td>
                                         </tr>
                                    </tbody>
                                </table>
                                <h2>Quote Typesdouble (") vs. single (') quotes</h2>
                                <table class="table benchmark">
                                    <tbody>
                                    <tr <?php if($data['quotes']['test1'] > $data['quotes']['test2']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>single (') quotes. Just an empty string: $tmp[] = '';</td>
                                        <td><?php echo $data['quotes']['test1'] . ' ms'; ?></td>
                                    </tr>
                                    <tr <?php if($data['quotes']['test1'] < $data['quotes']['test2']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>double (") quotes. Just an empty string: $tmp[] = "";</td>
                                        <td><?php echo $data['quotes']['test2'] . ' ms'; ?></td>
                                    </tr>
                                    <tr <?php if($data['quotes']['test3'] > $data['quotes']['test4']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>single (') quotes. 20 bytes Text : $tmp[] = 'aaaaaaaaaaaaaaaaaaaa';</td>
                                        <td><?php echo $data['quotes']['test3'] . ' ms'; ?></td>
                                    </tr>
                                    <tr <?php if($data['quotes']['test3'] < $data['quotes']['test4']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>double (") quotes. 20 bytes Text : $tmp[] = "aaaaaaaaaaaaaaaaaaaa";</td>
                                        <td><?php echo $data['quotes']['test4'] . ' ms'; ?></td>
                                    </tr>
                                    <tr <?php if($data['quotes']['test5'] > $data['quotes']['test6']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>single (') quotes. 20 bytes Text and 3x a $ : $tmp[] = 'aa $ aaaa $ aaaa $ a';</td>
                                        <td><?php echo $data['quotes']['test5'] . ' ms'; ?></td>
                                    </tr>
                                    <tr <?php if($data['quotes']['test5'] < $data['quotes']['test6']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>double (") quotes. 20 bytes Text and 3x a $ : $tmp[] = "aa \$ aaaa \$ aaaa \$ a";</td>
                                        <td><?php echo $data['quotes']['test6'] . ' ms'; ?></td>
                                    </tr>
                                    <tr <?php if($data['quotes']['test7'] > $data['quotes']['test8']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>single (') quotes. $a = 'a'; $tmp[] = $a.' aaaa '.$a.' aaaa '.$a.' aaaa';</td>
                                        <td><?php echo $data['quotes']['test7'] . ' ms'; ?></td>
                                    </tr>
                                    <tr <?php if($data['quotes']['test7'] < $data['quotes']['test8']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>double (") quotes. $a = 'a'; $tmp[] = "$a aaaa $a aaaa $a aaaa";</td>
                                        <td><?php echo $data['quotes']['test8'] . ' ms'; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h2>Control Structures if vs. switch</h2>
                                <table class="table benchmark">
                                    <tbody>
                                    <tr <?php if($data['conditions']['test1'] > $data['conditions']['test2']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>if and elseif (using ==)</td>
                                        <td><?php echo $data['conditions']['test1'] . ' ms'; ?></td>
                                    </tr>
                                    <tr <?php if($data['conditions']['test1'] < $data['conditions']['test2']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>switch / case</td>
                                        <td><?php echo $data['conditions']['test2'] . ' ms'; ?></td>
                                    </tr>
                                    <tr <?php if($data['conditions']['test3'] > $data['conditions']['test4']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>if, elseif and else (using ==)</td>
                                        <td><?php echo $data['conditions']['test3'] . ' ms'; ?></td>
                                    </tr>
                                    <tr <?php if($data['conditions']['test3'] < $data['conditions']['test4']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>switch / case / default</td>
                                        <td><?php echo $data['conditions']['test4'] . ' ms'; ?></td>
                                    </tr>
                                    <tr <?php if($data['conditions']['test5'] > $data['conditions']['test6']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>if and elseif (using ===)</td>
                                        <td><?php echo $data['conditions']['test5'] . ' ms'; ?></td>
                                    </tr>
                                    <tr <?php if($data['conditions']['test5'] < $data['conditions']['test6']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>switch / case</td>
                                        <td><?php echo $data['conditions']['test6'] . ' ms'; ?></td>
                                    </tr>
                                    <tr <?php if($data['conditions']['test7'] > $data['conditions']['test8']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>if, elseif and else (using ===)</td>
                                        <td><?php echo $data['conditions']['test7'] . ' ms'; ?></td>
                                    </tr>
                                    <tr <?php if($data['conditions']['test7'] < $data['conditions']['test8']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>switch / case / default</td>
                                        <td><?php echo $data['conditions']['test8'] . ' ms'; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h2>Counting Loop: for() vs. while()</h2>
                                <table class="table benchmark">
                                    <tbody>
                                    <tr <?php if($data['countingLoops']['test1'] > $data['countingLoops']['test2']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>for($i = 0; $i < 1000; $i++);</td>
                                        <td><?php echo $data['countingLoops']['test1'] . ' ms'; ?></td>
                                    </tr>
                                    <tr <?php if($data['countingLoops']['test1'] < $data['countingLoops']['test2']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>$i = 0; while($i < 1000) $i++;</td>
                                        <td><?php echo $data['countingLoops']['test2'] . ' ms'; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h2>Read Loop: foreach() vs. for()</h2>
                                <table class="table benchmark">
                                    <tbody>
                                    <tr <?php if($data['reedLoop']['test1'] > $data['reedLoop']['test2']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>foreach($aHash as $key => $val);</td>
                                        <td><?php echo $data['reedLoop']['test1'] . ' ms'; ?></td>
                                    </tr>
                                    <tr <?php if($data['reedLoop']['test1'] < $data['reedLoop']['test2']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>$size = count($aHash); $keys = array_keys($aHash); for($i=0; $i<$size; $i++);</td>
                                        <td><?php echo $data['reedLoop']['test2'] . ' ms'; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h2>Write Loop: for() vs. while()</h2>
                                <table class="table benchmark">
                                    <tbody>
                                    <tr <?php if($data['writeLoop']['test1'] > $data['writeLoop']['test2']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>for($i=0; $i<1000; $i++);</td>
                                        <td><?php echo $data['writeLoop']['test1'] . ' ms'; ?></td>
                                    </tr>
                                    <tr <?php if($data['writeLoop']['test1'] < $data['writeLoop']['test2']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>while($i < 1000);</td>
                                        <td><?php echo $data['writeLoop']['test2'] . ' ms'; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h2>Modify Loop: foreach() vs. for()</h2>
                                <table class="table benchmark">
                                    <tbody>
                                    <tr <?php if($data['modifyLoop']['test1'] > $data['modifyLoop']['test2']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
                                        <td>foreach($aHash as $key=>$val) $aHash[$key] .= "a";</td>
                                        <td><?php echo $data['modifyLoop']['test1'] . ' ms'; ?></td>
                                    </tr>
                                    <tr <?php if($data['modifyLoop']['test1'] < $data['modifyLoop']['test2']) { echo "class='alert-danger'"; } else { echo "class='alert-success'"; }  ?>>
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
