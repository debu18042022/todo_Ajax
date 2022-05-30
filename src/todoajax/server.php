<?php
    session_start();
    if(!isset($_SESSION['todo'])){
        $_SESSION['todo']=array();
    }

    if(!isset($_SESSION['complete'])){
        $_SESSION['complete']=array();
    }



    
    // if(isset($_POST['info'])){
    //     $value = $_POST['info'];
    //     $_SESSION['todo'][]=$value;
    //     display_todo();
    // }

    function display_todo(){ 
        for($i=0;$i<count($_SESSION['todo']);$i++){
        echo "<li id=".$i."><input type='checkbox' id=".$i." class='accept'><label>".$_SESSION['todo'][$i]."</label><input type='text'>
        <button id=".$i." class='edit'>Edit</button>
        <button id=".$i." class='deleteTodo'>Delete</button></li>";
        }
    }


    if(isset($_POST['info'])){
        $value = $_POST['info'];
        $_SESSION['todo'][]=$value;
        display_todo();
    }


    if(isset($_POST['edit_value'])){
        $editValue = $_POST['edit_value'];
        $editIndex = $_POST['edit_index'];
        $_SESSION['todo'][$editIndex]=$editValue;
        display_todo();
        // echo $editValue;
        // echo $editIndex;
    }

    if(isset($_POST['del_index'])){
        $del_index = $_POST['del_index'];
        array_splice($_SESSION['todo'],$del_index,1);
        display_todo();
    }

    function display_complete(){
        for($j=0;$j<count($_SESSION['complete']);$j++){
            echo "<li><input type='checkbox' checked class='uncheckedAccept' id=".$j."><label>".$_SESSION['complete'][$j]."</label><input type='text'><button class='edit' id=".$j." >Edit</button><button class='DeleteComp' id=".$j.">Delete</button></li>";
        }
    }

    if(isset($_POST['checked_index'])){
        $checkedIndex = $_POST['checked_index'];
        $_SESSION['complete'][]=$_SESSION['todo'][$checkedIndex];
        array_splice($_SESSION['todo'],$checkedIndex,1);
       // display_todo();
        display_complete();
    }

    if(isset($_POST['checked_indx'])){
        display_todo();
    }

    if(isset($_POST['deleted_index'])){
      //  echo "hello";
        $com_del_index = $_POST['deleted_index'];
        array_splice($_SESSION['complete'],$com_del_index,1);
        display_complete();
    }

    if(isset($_POST['edited_value'])){
        $editedvalue=$_POST['edited_value'];
        $editedindex=$_POST['edited_index'];
        $_SESSION['complete'][$editedindex]=$editedvalue;
        display_complete();
    }

    if(isset($_POST['unchecked_index'])){
        $uncheckedIndex=$_POST['unchecked_index'];
        $_SESSION['todo'][]=$_SESSION['complete'][$uncheckedIndex];
        array_splice($_SESSION['complete'],$uncheckedIndex,1);
        display_complete();
    }

    if(isset($_POST['unchecked_indx'])){
        display_todo(); 
    }


?>
