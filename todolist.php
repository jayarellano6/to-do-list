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
            swap($_SESSION['actions'][$_POST['checkoff']], $_SESSION['actions'][count($_SESSION['actions'])-1]);
            array_pop($_SESSION['actions']);
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

?>
<html>
    <head>
        <title>to-do list</title>
        <style type="text/css">
            body{
                font-family:'Slabo 27px';
                background-color: #264166;
                /*margin:0;*/
                color:white;
            }
            form{
                margin:0;
            }
            header, #addAction, h4, #listContent, table, #update{
                text-align:center;
            }
            header{
                font-size: 35px;
                word-spacing: 6px;
                letter-spacing: 2px;
            }
            td{
                border-style:solid;
                border-color:#264166;
                border-width:.5px;
                font-size: 20px;
                padding-left: 25px;
                padding-right: 25px;
                padding-top:5px;
                padding-bottom:5px;
                background-color:white;
                color:#264166;
            }
            table{
                border-spacing:0;
                margin-left:auto; 
                margin-right:auto; 
            }
            #head1, #head2{
                background-color:#ff6b8b;
                color:#264166;
                border-color:white;
            }
            input[type=submit]{
                background-color:#ff6b8b;
                color: white;
                border-color:white;
                padding:10px;
            }
            input[type=text]{
                background-color:#ff6b8b;
                color: white;
                border-color:white;
                padding:10px;
            }
             input[type=text]::placeholder{
                color: white;
                opacity:1;
            }
            h4{
                text-decoration: underline;
                margin-bottom: 5px;
                font-size:22px;
                font-weight: normal;
            }
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
            <!--<form id="update" method="post">-->
            <!--    <input type="submit" name="up" value="update"/>-->
            <!--</form>-->
        </div>
    </body>
</html>