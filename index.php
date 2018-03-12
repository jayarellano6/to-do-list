<!DOCTYPE html>
<?php
    session_start();
    
    function swap(&$x,&$y) {
        $tmp=$x;
        $x=$y;
        $y=$tmp;
    }
    
    if(isset($_POST['checkoff'])){
        if(count($_SESSION['actions']) == 1)
        {
            array_pop($_SESSION['actions']);
        }
        else{
            unset($_SESSION['actions'][$_POST['checkoff']]);
            $_SESSION['actions'] = array_values($_SESSION['actions']);
            // swap($_SESSION['actions'][$_POST['checkoff']], $_SESSION['actions'][count($_SESSION['actions'])-1]);
            // array_pop($_SESSION['actions']);
        }
        // unset($_SESSION['actions'][(int)$_POST['checkoff']]);
    }
    if(!isset($_SESSION['actions'])){
        $_SESSION['actions'] = array();
        // array_pop($_SESSION['actions']);
    }
    if(isset($_POST['item'])){
        if($_POST['item']!= ""){
            array_push($_SESSION['actions'], $_POST['item']); 
            
        }
        unset($_POST['item']);
    }
    if(isset($_POST['up'])){
        shuffle($_SESSION['actions']);
    }

?>
<html>
    <head>
        <title>to-do list</title>
        <style type="text/css">
            @import url("./styles.css");
        </style>
        <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
    </head>
    
    <body>
        <header>TO-DO LIST</header>
        <hr width="50%">
        <br><br>
        
        <form id="addAction" method="post">
            <label for="item" style="font-size:  26px;">Add Action to List</label><br>
            <input type="text" name="item" placeholder="action">
            <input type="submit" value="add">
        </form>
        
        <h4>List</h4>
        <div id="listContest">
            <table id="listTable">
                <tbody>
                <tr>
                    <td id="head1">check off action</td>
                    <td id="head2">to-do action</td>
                </tr>
                
                <?php 
                    if(isset($_SESSION['actions']) && !empty($_SESSION['actions'])){
                        for($i = 0; $i < sizeof($_SESSION['actions']); $i++){ ?>
                <tr>
                    <td>
                        <form method="post">
                            <?php echo "<input type='hidden' id = 'checked' name='checkoff' value = $i />"; 
                                  echo "<button>check</button>";?>
                        </form>
                    </td>
                    <?php echo "<td>".$_SESSION['actions'][$i]."</td>"; ?>
                </tr> 
                <?php }
                    } ?>
                </tbody>
            </table>
            <!--<input type="radio" id = "checked" name="do" value = "check"/>-->
            <br><br>
            
            <form id="update" method="post">
                <input type="submit" name="up" value="suffle list"/>
            </form>
        </div>
    </body>
</html>