<?php
error_reporting(0);

header("Content-Type: text/html; charset=UTF-8");
$url = 'http://wwwinfo.mfcr.cz/cgi-bin/ares/darv_bas.cgi?ico=';
$ico = (int)$_GET['ico'];
$url = $url . $ico;

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
$data = curl_exec($curl);
curl_close($curl);

if ($data) $xml = simplexml_load_string($data);

$a = array();

if (isset($xml)) {
    $ns = $xml->getDocNamespaces();
    $data = $xml->children($ns['are']);
    $el = $data->children($ns['D'])->VBAS;
    if (strval($el->ICO) == $ico) {
        $a['ico']     = strval($el->ICO);
        $a['dic']     = strval($el->DIC);
        $a['firma'] = strval($el->OF);

        $a['jmeno'] = "";
        $a['prijmeni'] = "";
        // detekce jména a firmy ..
        $firma = $a['firma'];
        $roz = explode(" ",$firma);
        $match = preg_match("/(s\.r\.o\.|s\. r\. o\.|spol\. s r\.o\.|a\.s\.|a\. s\.|v\.o\.s|v\. o\. s\.|o\.s\.|k\.s\.|kom\.spol\.)/",$firma);
        if (count($roz) == 2 AND !$match) {
            // nenašli jsme shodu s firmou, pravděpodobně se jedná o živnostníka se jménem ..
            $a['jmeno'] = $roz[0];
            $a['prijmeni'] = $roz[1];
        }

        $a['ulice']    = strval($el->AA->NU);
        if (!empty($el->AA->CO) OR !empty($el->AA->CD)) {
            // detekování popisného a orientačního čísla
            $a['ulice'] .= " ";
            if (!empty($el->AA->CD)) $a['ulice'] .= strval($el->AA->CD);
            if (!empty($el->AA->CO) AND !empty($el->AA->CD)) $a['ulice'] .= "/";
            if (!empty($el->AA->CO)) $a['ulice'] .= strval($el->AA->CO);
        }

        $a['mesto']    = strval($el->AA->N);
        $a['psc']    = strval($el->AA->PSC);
        $a['stav']     = 'ok';
    } else {
        $a['stav']     = 'IČ firmy nebylo v databázi ARES nalezeno';
    }
} else {
    $a['stav']     = 'Databáze ARES není dostupná';
}

$b = $a['ico'];
$c = $a['dic'];
$d = $a['firma'];
$e = $a['ulice'];
$f = $a['mesto'];
$g = $a['psc'];
$h = $a['stav'];

$dat = date('d. m. Y. H : i');

echo "<table border='3'>";
echo "<tr><th>IČO</th><th>DIČ</th><th>Firma</th><th>Ulice</th><th>Město</th><th>PSČ</th><th>stav</th><th>Datum a čas</th></tr>";
echo "<tr><td>$b</td><td>$c</td><td>$d</td><td>$e</td><td>$f</td><td>$g</td><td>$h</td><td>$dat</td></tr>";
echo "</table>";

$servername="sql.sweb.cz";  //"sql.sweb.cz";
$username="stvalenta"; //"php_request";
$password="e6MKbqR";   //"phprequest";
$database_name="stvalenta";

$conn=mysqli_connect($servername,$username,$password,$database_name);

if(!$conn)
{
    die("Connection Faild:" . mysqli_connect_error());
}
$sql_query = "INSERT INTO firmy_podle_ico (ico,dic,firma,ulice,mesto,psc,stav,datum_cas) VALUES ('$b','$c','$d','$e','$f','$g','$h','$dat')";

if(mysqli_query($conn, $sql_query))
{
    echo "Snad to vyšlo";
}
else
{
    echo "Error: " . $sql . "" . mysqli_error($conn);
}

$conn->close();
?>
<?php
 //index.php
 $connect = mysqli_connect('sql.sweb.cz', 'stvalenta', 'e6MKbqR', 'stvalenta');
 $query = "SELECT * FROM firmy_podle_ico ORDER BY id DESC";
 $result = mysqli_query($connect, $query);
 ?>
 <!DOCTYPE html>
 <html>
      <head>
           <title>Výpis z databáze, možnost seředit výsledky...</title>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      </head>
      <body>
           <br />
           <div class="container" align="center">
                <h3 class="text-center">Výpis z databáze, možnost seředit výsledky...</h3><br />
                <div class="table-responsive" id="employee_table">
                     <table class="table table-bordered">
                          <tr>
                               <th><a class="column_sort" id="ico" data-order="desc" href="#">IČO</a></th>
                               <th><a class="column_sort" id="dic" data-order="desc" href="#">DIČ</a></th>
                               <th><a class="column_sort" id="firma" data-order="desc" href="#">Firma</a></th>
                               <th><a class="column_sort" id="ulice" data-order="desc" href="#">Ulice</a></th>
                               <th><a class="column_sort" id="mesto" data-order="desc" href="#">Město</a></th>
                               <th><a class="column_sort" id="psc" data-order="desc" href="#">PSČ</a></th>
                               <th><a class="column_sort" id="stav" data-order="desc" href="#">Stav</a></th>
                               <th><a class="column_sort" id="datum_cas" data-order="desc" href="#">Datum a Čas</a></th>
                          </tr>
                          <?php
                          $zzz = 0;
                          while(($row = mysqli_fetch_array($result)) && ($zzz <= 2))
                          {
                            $zzz++;
                          ?>
                          <tr>
                               <td><?php echo $row["ico"]; ?></td>
                               <td><?php echo $row["dic"]; ?></td>
                               <td><?php echo $row["firma"]; ?></td>
                               <td><?php echo $row["ulice"]; ?></td>
                               <td><?php echo $row["mesto"]; ?></td>
                               <td><?php echo $row["psc"]; ?></td>
                               <td><?php echo $row["stav"]; ?></td>
                               <td><?php echo $row["datum_cas"]; ?></td>
                          </tr>
                          <?php
                          }
                          ?>
                     </table>
                </div>
           </div>
           <br />
      </body>
 </html>
 <script>
 $(document).ready(function(){
      $(document).on('click', '.column_sort', function(){
           var column_name = $(this).attr("id");
           var order = $(this).data("order");
           var arrow = '';
           //glyphicon glyphicon-arrow-up
           //glyphicon glyphicon-arrow-down
           if(order == 'desc')
           {
                arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-down"></span>';
           }
           else
           {
                arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-up"></span>';
           }
           $.ajax({
                url:"sort.php",
                method:"POST",
                data:{column_name:column_name, order:order},
                success:function(data)
                {
                     $('#employee_table').html(data);
                     $('#'+column_name+'').append(arrow);
                }
           })
      });
 });
 </script>
