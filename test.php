<?php

$total = [
    [
    "month" => 10,
    "total" => 1,
    ],
    [
    "month" => 11,
    "total" => 1,
    ],
    [
    "month" => 12,
    "total" => 4,
    ]
];

$reject = [
    [
    "month" => 10,
    "approve" => 1,
    ],
    [
    "month" => 12,
    "approve" => 1,
    ]
];

$approve = [
    [
    "month" => 10,
    "approve" => 1,
    ],
    [
    "month" => 12,
    "approve" => 1,
    ]
];

$month = [
    1,2,3,4,5,6,7,8,9,10,11,12
];

var_dump($total);
var_dump($reject);
var_dump($approve);
var_dump($month);
echo "<br><br>";
$x = 0;
foreach ($reject as $row) {
    $monthReject[] = $row['month'];
}
foreach ($approve as $key => $val) {
    $monthApprove[] = $val['month'];
}
$missReject = array_diff($month,$monthReject);
// var_dump($missReject);
foreach($missReject as $row) {
    $arrMiss[] = [
        "month" => $row,
        "reject" => 0,
    ];
}
echo "<br><br>";
$res = array_merge($arrMiss,$reject);
// var_dump($arrMiss);
sort($res);
var_dump($res);
$missApprove = array_diff($month,$monthApprove);

?>