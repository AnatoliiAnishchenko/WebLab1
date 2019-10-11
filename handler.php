<?php
session_start();
if ($_POST['submit-button']) {
    session_destroy();
} else {
    $START_TIME = microtime(TRUE);
    $RESULT = 'NO';
    $IS_CORRECT = TRUE;
    $X = 0;
    $Y = 0;
    $R = 1;

    $VALUES_NUMBER = (int) $_SESSION['VALUES_COUNTER'];
    $_SESSION['VALUES_COUNTER'] = $_SESSION['VALUES_COUNTER'] + 1;
    $VALUES_ARRAY = $_SESSION['VALUES_ARRAY'];
    $_SESSION['VALUES_ARRAY'] = $VALUES_ARRAY;

    if ($_GET['X'] >= -4 && $_GET['X'] <= 4) {
        $X = (int) $_GET['X'];
    } else {
        $IS_CORRECT = FALSE;
        $X = '<b>Wrong X value!!!</b>';
    }

    if ($_GET['Y'] > -3 && $_GET['Y'] < 5) {
        $Y = (float) $_GET['Y'];
    } else {
        $IS_CORRECT = FALSE;
        $Y = '<b>Wrong Y value!!!</b>';
    }

    if ($_GET['R'] >= 1 && $_GET['R'] <= 5) {
        $R = (float) $_GET['R'];
    } else {
        $IS_CORRECT = FALSE;
        $R = '<b>Wrong R value!!!</b>';
    }

    if ($IS_CORRECT && ($X >= 0 && $Y >= 0 && $X <= $R && $Y <= $R / 2 ||
            $X >= 0 && $Y <= 0 && $X * $X + $Y * $Y <= $R * $R / 4 ||
            $X < 0 && $Y < 0 && $X * 2 + $Y >= -$R)) {
        $RESULT = 'YES';
    } else {
        $RESULT = 'NO';
    }

    date_default_timezone_set('Europe/Moscow');
    $REQUEST_TIME = date("H:i:s");

    $BENCHMARK = microtime(TRUE) - $START_TIME;

    $VALUES_ARRAY[$VALUES_NUMBER] = array('X' => $X, 'Y' => $Y, 'R' => $R, 'RESULT' => $RESULT, 'REQUEST_TIME' => $REQUEST_TIME, 'BENCHMARK' => $BENCHMARK);
    $_SESSION['VALUES_ARRAY'] = $VALUES_ARRAY;

    $TABLE = " ";
    for ($i = 0; $i < count($VALUES_ARRAY); ++$i) {
        $TABLE = $TABLE . '<tr>';
        $TABLE = $TABLE . "<td>" .
            $VALUES_ARRAY[$i]['X'] .
            "</td>";
        $TABLE = $TABLE . "<td>" .
            $VALUES_ARRAY[$i]['Y'] .
            "</td>";
        $TABLE = $TABLE . "<td>" .
            $VALUES_ARRAY[$i]['R'] .
            "</td>";
        $TABLE = $TABLE . "<td>" .
            $VALUES_ARRAY[$i]['RESULT'] .
            "</td>";
        $TABLE = $TABLE . "<td>" .
            $VALUES_ARRAY[$i]['REQUEST_TIME'] .
            "</td>";
        $TABLE = $TABLE . "<td>" .
            $VALUES_ARRAY[$i]['BENCHMARK'] .
            "</td>";
        $TABLE = $TABLE . '</tr>';
    }
}
?>

<html lang="en">

<head>
    <title>PHP</title>
</head>

<body>
<div>
    <table>
        <tr>
            <td>
                <b>X</b>
            </td>
            <td>
                <b>Y</b>
            </td>
            <td>
                <b>R</b>
            </td>
            <td>
                <b>Result</b>
            </td>
            <td>
                <b>Current time</b>
            </td>
            <td>
                <b>Benchmark</b>
            </td>
        </tr>

        <?php
        echo "$TABLE";
        ?>
    </table>

    <form method="POST" action="" class = "left-form">
        <input type="submit" name="submit-button" value = "Reset">
    </form>

    <form method="GET" action="index.html" class = "right-form">
        <input type="submit" name="submit-button" value = "Back">
    </form>
</div>
</body>

</html>

<style>
    body {
        margin: auto;
        background: #FFFFFF;
    }

    table {
        margin: 100px auto auto;
    }

    form {
        text-align: center;
        margin: 20px;
    }

    .left-form {
        float: left;
        margin-left: 40vw;
    }

    .right-form {
        float: right;
        margin-right: 40vw;
    }

    input{
        font-size: 18px;
        padding: 15px;
        margin-top: 25px;
        background: #1946BA;
        color: #FFFFFF;
        border-radius: 4px;
        margin-bottom: 50px;
        transition: 0.3s ease-in;
    }

    table,
    tr,
    td {
        text-align: center;
        border: 2px solid #00008B;
        border-collapse: collapse;
    }
</style>