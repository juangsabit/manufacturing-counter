<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )) {

    // nama table
    $table = 'log';
    // Table's primary key
    $primaryKey = 'id';
    $columns = array(
        array( 'db' => 'line', 'dt' => 1 ),
        array( 'db' => 'model', 'dt' => 2 ),
        array( 'db' => 'ok', 'dt' => 3 ),
        array( 'db' => 'ng', 'dt' => 4 ),
        array( 'db' => 'start', 'dt' => 5 ),
        array( 'db' => 'end', 'dt' => 6 ),
        array( 
            'db' => 'start', 
            'dt' => 7,
            'formatter' => function( $d, $row ) {
                $start = strtotime($row['start']);
                $end = strtotime($row['end']);
                $duration = $end - $start;
                $out = gmdate("H:i:s", $duration);
                return $out;
            } ),
        array( 'db' => 'id', 'dt' => 8 ),
    );

    // SQL server connection information
    require_once "config/database.php";
    // ssp class
    require 'config/ssp.class.php';
    // require 'config/ssp.class.php';

    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
    );
} else {
    echo '<script>window.location="index.php"</script>';
}
?>