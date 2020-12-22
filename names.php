<?php
$host = 'localhost'; // адрес сервера 
$database = 'fbstat'; // имя базы данных
$user = 'belych'; // имя пользователя
$password = '635241ww'; // пароль

$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
$sql="SET NAMES utf8";
mysqli_query($link, $sql);
$query ="SELECT name FROM player where country_id=1";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
$players = [];
while ($row = mysqli_fetch_row($result)) {
    $players[] = substr($row[0], 0, strpos($row[0], " "));
    //echo $row[0]."<br/>";
}
$players2 = array_count_values($players);
arsort($players2);
?>
<table border="1">
<?php
$i=1;
foreach($players2 as $k => $v) {?>
    <tr>
        <td>
            <?=$i?>
        </td>
        <td>
            <?=$k?>
        </td>
        <td>
            <?=$v?>
        </td>
    </tr>
    <?php
    $i++;

}
?>
</table>



