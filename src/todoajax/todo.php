<html>
    <head>
        <title>TODO List</title>
        <link href="style.css" type="text/css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    </head>
    <body>
        <a href="session_destroy.php">destroy session</a>
        <div class="container">
            <h2>TODO LIST</h2>
            <h3>Add Item</h3>
            <p>
               
                <input id="new-task" type="text" name="new_task">
                <button class="addbutton">Add</button>
                <button class="updatebutton" hidden>update</button>
                <input type="hidden" id="editTask" name="editTask"> 
              
            </p>

            <div id='disdiv'></div>
    
            <h3>Todo</h3>
            <ul id="incomplete-tasks">
                <!-- <li><input type="checkbox"><label>Pay Bills</label><input type="text"><button class="edit">Edit</button><button class="delete">Delete</button></li>
                <li><input type="checkbox"><label>Go Shopping</label><input type="text" value="Go Shopping"><button class="edit">Edit</button><button class="delete">Delete</button></li> -->
                
               <script>
                   $(document).ready(function(){
                    var index;
                    $(document).on("click",".addbutton",function(){
                        console.log($("#new-task").val());
                        var value = $("#new-task").val();
                        $.ajax({
                            url:'server.php',
                            method:'POST',
                            data:{'info':value},
                            success:function(result){
                             //   console.log(result);
                                $("#incomplete-tasks").html(result);
                            }
                        });
                    });
                    $("#incomplete-tasks").on("click",".edit",function(){
                        index = $(this).attr('id');
                        alert($(this)[0].id);
                        var editText = $(this).parent().children().eq(1).text();
                        $("#new-task").val(editText);
                        $(".addbutton").hide();
                        $(".updatebutton").show();
                        $("#editTask").val(0);
                    });

                    // $(document).on("click",".updatebutton",function(){
                    //     let value = $("#new-task").val();
                    //  //   alert(value);
                    //     console.log(index);
                    //     $(".addbutton").show();
                    //     $(".updatebutton").hide();
                    //     $.ajax({
                    //         url:'server.php',
                    //         method:'POST',
                    //         data:{'edit_value':value,'edit_index':index},
                    //         success:function(result){
                    //             $("#incomplete-tasks").html(result);
                    //             //$("#disdiv").text(result); 
                    //         }
                    //     })
                    // });

                    $(document).on("click",".deleteTodo",function(){
                        let index = $(this).attr('id');
                       // alert($(this)[0].id);
                       alert(index);
                        console.log(index);
                        $.ajax({
                            url:'server.php',
                            method:'POST',
                            data:{'del_index':index},
                            success:function(result){
                                $("#incomplete-tasks").html(result); 
                            }
                        })
                    });

                    $(document).on("click",".accept",function(){
                        let checkedIndex = $(this).attr('id');
                        console.log(checkedIndex);
                       // alert($(this)[0].id);
                       $.ajax({
                           url:'server.php',
                           method:'POST',
                           data:{'checked_index':checkedIndex},
                           success:function(result){
                               $("#completed-tasks").html(result);
                           }
                       })

                       $.ajax({
                           url:'server.php',
                           method:'POST',
                           data:{'checked_indx':checkedIndex},
                           success:function(result){
                               $("#incomplete-tasks").html(result);
                           }
                       })
                    });

                    $(document).on("click",".DeleteComp",function(){
                        let index = $(this).attr('id');
                     // alert($(this)[0].id);
                        alert(index);
                        console.log(index);
                        $.ajax({
                            url:'server.php',
                            method:'POST',
                            data:{'deleted_index':index},
                            success:function(result){
                                $("#completed-tasks").html(result);
                            } 
                        })
                    })
                    
                    $("#completed-tasks").on("click",".edit",function(){
                        index =$(this).attr('id');
                        edited_text=$(this).parent().children().eq(1).text();
                        alert(index);
                        alert(edited_text);
                        $("#new-task").val(edited_text);
                        $(".updatebutton").show();
                        $(".addbutton").hide();
                        $("#editTask").val(1);
                    });

                    $(document).on("click",".updatebutton",function(){
                        let value = $("#new-task").val();
                     //   alert(value);
                        console.log(index);
                        $(".addbutton").show();
                        $(".updatebutton").hide();
                        let hidden_value = $("#editTask").val();
                        if(hidden_value == 0){
                            $.ajax({
                            url:'server.php',
                            method:'POST',
                            data:{'edit_value':value,'edit_index':index},
                            success:function(result){
                                $("#incomplete-tasks").html(result);
                                //$("#disdiv").text(result); 
                               // $("#completed-tasks").html(result);
                            }
                        })}
                        else{
                            $.ajax({
                                url:'server.php',
                                method:'POST',
                                data:{'edited_value':value,'edited_index':index},
                                success:function(result){
                                     $("#completed-tasks").html(result);
                                //$("#disdiv").text(result); 
                            }
                            })
                        }
                    });

                    $(document).on("click",".uncheckedAccept",function(){
                        let index = $(this).attr('id');
                        alert(index);
                        $.ajax({
                            url:'server.php',
                            method:'POST',
                            data:{'unchecked_index':index},
                            success:function(result){
                                $("#completed-tasks").html(result); 
                            }
                        })

                        $.ajax({
                            url:'server.php',
                            method:'POST',
                            data:{'unchecked_indx':index},
                            success:function(result){
                                $("#incomplete-tasks").html(result); 
                            }
                        })
                        

                    });

                });

               </script> 

            </ul>
    
            <h3>Completed</h3>
            <ul id="completed-tasks">
                <!-- <li><input type="checkbox" checked><label>See the Doctor</label><input type="text"><button class="edit">Edit</button><button class="delete">Delete</button></li> -->
            </ul>
        </div>
    
    </body>
</html>