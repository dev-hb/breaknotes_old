<?php include("header.php")?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Special Links</h4>
                                <p class="category">Last Added</p>
                            </div>
                            <div class="content">
                                <div class="table-full-width">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Visibility</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $res = $conn->query("select * from links where id_user=$id_user order by id_link desc limit 6");
                                                while($row = $res->fetch_array()){
                                                    $visibility=$row['visibility_link']==0?"lock":"globe";
                                                    echo "<tr>
                                                <td>
													<a href='{$row['ref_link']}' target='_blank'>{$row['label_link']}</a>
                                                </td>
                                                <td>
													{$row['comment']}
                                                </td>
                                                <td>
                                                    <i class='fa fa-$visibility'></i>
                                                </td>
                                            </tr>";
                                                }
                                                if(mysqli_num_rows($res)<=0){
                                                    echo "<tr><td align=center colspan=3><center><small>No links found go to <a href='links.php'>My Links</a></small></center></td></tr>";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="footer">
                                    <hr>
                                    <label>some description</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

<?php include("footer.php");?>

<script type="text/javascript">
function saveUpdates(id, elem){
    var ch;
    if(elem.checked) {ch = 1;und = 0;}
    else {ch = 0; und = 1;}
    $(".loader").load("index.php?update_status="+id+"&val="+ch+" .update_status");
    updateView();
    var msg = "The task has been marekd as done! <button onclick='undo("+id+", "+und+")' class='btn btn-success linknotify'>UNDO</button>";
    $.notify({
        icon: "pe-7s-info",
        message: msg

    },{
        type: type[3],
        timer: 4000
    });
}
    
function updateView(){
    setTimeout(function(){
        $(".coming").load("index.php .coming");
        $(".monthlyUndone").load("index.php .monthlyUndone");
    }, 100)
}

function undo(id, val){
    $(".loader").load("index.php?update_status="+id+"&val="+val+" .update_status");
    updateView();
}

$(document).ready(function(){
    $('#page_home').attr('class', 'active');
})
</script>

<script type="text/javascript">

</script>