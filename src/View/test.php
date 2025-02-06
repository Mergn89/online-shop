<?php
$a = 5;
//$b = &$a;
//$b++;
//echo $a;
function test(int &$a)
{
   $a++;

}
test($a);
