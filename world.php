<?php
header('Access-Control-Allow-Origin: *');

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$country= filter_input(INPUT_GET, "country", FILTER_SANITIZE_STRING);
$countryQ = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
$citiesQ= $conn->query("SELECT cities.name, cities.district, cities.population FROM countries join cities on cities.country_code = countries.code WHERE countries.name LIKE '%$country'"); 

$results = $countryQ->fetchAll(PDO::FETCH_ASSOC);
$cities= $citiesQ->fetchAll(PDO::FETCH_ASSOC);

$page= $_SERVER['REQUEST_URI'];
$url=parse_url($page,PHP_URL_QUERY);
parse_str($url,$param);
$context= $param['context'];

?>

<?php if($context== "cities"):?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>District</th>
                    <th>Population</th>
                </tr>
            </thead>
        <tbody>
        <?php foreach ($cities as $row):?>
            <tr>
                <td><?php echo $row['name']; ?></td> 
                <td><?php echo $row['district']; ?></td>
                <td><?php echo $row['population']; ?></td>
            <tr>
        <?php endforeach;?>
        </tbody>
    </table>

    <?php else: ?>
        <?php unset($page,$url,$context);?>
        <?php $page= null;?>
        <?php $url= null;?>
        <?php $context= null;?>
        <table>
            <thead>
                <tr>
                    <th>Country Name</th>
                    <th>Continent</th>
                    <th>Independence Year</th>
                    <th>Head of State</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($results as $row):?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['continent']; ?></td>
                    <td><?php echo $row['independence_year']; ?></td>
                    <td><?php echo $row['head_of_state'];?></td>
                <tr>
            <?php endforeach;?>
            </tbody>
        </table>
    <?php endif; ?>
