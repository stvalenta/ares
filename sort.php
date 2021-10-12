<?php
 //sort.php
 $connect = mysqli_connect("sql.sweb.cz", "stvalenta", "e6MKbqR", "stvalenta");
 $output = '';
 $order = $_POST["order"];
 if($order == 'desc')
 {
      $order = 'asc';
 }
 else
 {
      $order = 'desc';
 }
 $query = "SELECT * FROM firmy_podle_ico ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."";
 $result = mysqli_query($connect, $query);
 $output .= '
 <table class="table table-bordered">
      <tr>
           <th><a class="column_sort" id="ico" data-order="'.$order.'" href="#">IČO</a></th>
           <th><a class="column_sort" id="dic" data-order="'.$order.'" href="#">DIČ</a></th>
           <th><a class="column_sort" id="firma" data-order="'.$order.'" href="#">Firma</a></th>
           <th><a class="column_sort" id="ulice" data-order="'.$order.'" href="#">Ulice</a></th>
           <th><a class="column_sort" id="mesto" data-order="'.$order.'" href="#">Město</a></th>
           <th><a class="column_sort" id="psc" data-order="'.$order.'" href="#">PSČ</a></th>
           <th><a class="column_sort" id="stav" data-order="'.$order.'" href="#">Stav</a></th>
           <th><a class="column_sort" id="datum_cas" data-order="'.$order.'" href="#">Datum a Čas</a></th>
      </tr>
 ';
 $yyy = 0;
 while (($row = mysqli_fetch_array($result)) && ($yyy <=2)){
   $yyy++;
           $output .= '
           <tr>
           <td>' . $row["ico"] . '</td>
           <td>' . $row["dic"] . '</td>
           <td>' . $row["firma"] . '</td>
           <td>' . $row["ulice"] . '</td>
           <td>' . $row["mesto"] . '</td>
           <td>' . $row["psc"] . '</td>
           <td>' . $row["stav"] . '</td>
           <td>' . $row["datum_cas"] . '</td>
           </tr>
           ';
 }
 $output .= '</table>';
 echo $output;
 ?>
