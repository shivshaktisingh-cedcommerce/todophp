<?php 
session_start();
//session_destroy();
if(!isset($_SESSION['incomplete'])){
    $_SESSION['incomplete']=array();
}
if(!isset($_SESSION['complete'])){
    $_SESSION['complete']=array();
}
?>
<?php
   if(isset($_GET['ADD']) && $_GET['task']!=""){
        $taskhere=$_GET['task'];
        $_SESSION['incomplete'][$taskhere]=$taskhere;
   }
?>
<?php
    if(isset($_GET['action'])){
        $task_value=$_GET['key'];
        $btn_value = "Update";
        $array=$_GET['arr'];
        $count=0;
        foreach($_SESSION[$array] as $key => $value)
        {
            if($value==$task_value)
            break;
            else $count++;
        }
        $_SESSION['new']=array($array,$count);
    }
?>
<?php 
    if(isset($_GET['Update']) && $_GET['task']!="")
    {
        $key = $_GET['task'];
        $array=$_SESSION['new'][0];
        $count=$_SESSION['new'][1];
        $temp_arr=array($key=>$key);
        array_splice($_SESSION[$array],$count,1,$temp_arr);
        unset($_SESSION['new']);
    }
?>

<?php
    if(isset($_GET['action1'])){
    $array1=$_GET['action1'];
    $delete=$_GET['key'];
    foreach($_SESSION[$array1] as $key => $value){
        if($delete==$value){
            unset($_SESSION[$array1][$key]);
            break;
        }
    }
    unset($_SESSION[$array1][$delete]);
}
    
?>
<?php
if(isset($_GET['check'])){
    $_SESSION['comp']++;
    $index=$_SESSION['comp'];
    $shift=$_GET['check'];
    $_SESSION['complete'][$index]=$_SESSION['incomplete'][$shift];
    unset($_SESSION['incomplete'][$shift]);
}
?>
<?php
if(isset($_GET['check1'])){
    $_SESSION["inc"]++;;
    $index=$_SESSION["inc"];
    $shift=$_GET['check1'];
    $_SESSION["incomplete"][$index]=$_SESSION["complete"][$shift];
    unset($_SESSION["complete"][$shift]);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <script>
        function check(E){
            window.location.href="?check="+E;
        }
        function check1(E){
            window.location.href="?check1="+E;
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>TODO LIST</h2>
        <h3>Ad Item</h3>
        <p>
            <form method="GET" action="">
                <input tye="text" id="new-task" name="task" value="<?php if(isset($task_value)) echo $task_value; ?>">
                <input type="submit" name="<?php if(isset($btn_value)) echo $btn_value; else echo 'ADD'; ?>" value="<?php if(isset($btn_value)) echo $btn_value; else echo 'ADD'; ?>">
            </form>
        </p>
        <h3>Todo</h3>
        <ul id="incomplete-tasks">
            <?php foreach($_SESSION['incomplete'] as $key => $value){ ?>
                <li>
                    <input type="checkbox" value="<?php echo $key; ?>" onclick="check(this.value)">
                    <label><?php echo $value; ?></label>
                    <a class="edit" href="?action=edit&key=<?php echo $value; ?>&arr=incomplete">Edit</a>
                    <a class="delete" href="?action1=incomplete&key=<?php echo $value; ?>">Delete</a>
                </li>
            <?php } ?>
        </ul>
        <h3>Completed</h3>
        <ul id="completed-tasks">
            <?php foreach($_SESSION['complete'] as $key => $value){ ?>
                <li>
                    <input type="checkbox" checked value="<?php echo $key; ?>" onclick="check1(this.value)">
                    <label><?php echo $value; ?></label>
                    <a class="edit" href="?action=edit&key=<?php echo $value; ?>&arr=complete">Edit</a>
                    <a class="delete" href="?action1=complete&key=<?php echo $value; ?>">Delete</a>
                </li>
            <?php } ?>
        </ul>
    </div>

</body>
</html>