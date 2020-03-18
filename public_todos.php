<?php include("header.php");

$nblinks = $conn->query("SELECT count(*) as nb from links where visibility_link=1 and is_todo=1")->fetch_array()['nb'];

?>

<div class="setlike">
<?php
if(isset($_GET['like'])){
    if(! is_numeric($_GET['like'])){
        die("Oh please, are you sure about this, get out of my face negga");
    }else{
        $conn->query("insert into likes_of_links values ('', $id_user, {$_GET['like']})");
    }
}
?>
</div>
<div class="setdislike">
<?php

// fix
if(isset($_GET['dislike'])){
    if(! is_numeric($_GET['dislike'])){
        die("Oh please, are you sure about this, get out of my face negga");
    }else{
        $conn->query("delete from likes_of_links where id_link={$_GET['dislike']} and id_user=$id_user)");
    }
}
?>
</div>
<style>
    .rww{
        transition: all .3s ease;
        margin:20px;
        padding:10px;
        box-shadow: 0px 1px 8px #EEEEEE;
    }
    .rww:hover{
        transition: all .3s ease;
        transform: scale(1.02);
        box-shadow: 0px 1px 8px #cccccc;
    }
</style>
<div class="executer"></div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Public Links </h4>
                                <p class="category">Total of links <b><?php echo $nblinks;?></b></p>
                            </div>
                            <div class="content table-responsive table-full-width data-links">
                                <?php
                                function iLikeIt($arr, $id){
                                    while($rr = $arr->fetch_array())
                                        if($rr['id_user'] == $id) return true;
                                    return false;
                                }


                                $res = $conn->query("SELECT * from links natural join users where visibility_link=1 and is_todo=1 order by id_link desc");
                                while ($row = $res->fetch_array()) {
                                    $likes = $rs = $conn->query("select * from users natural join likes_of_links where id_link={$row['id_link']}");
                                    $nblikes = mysqli_num_rows($likes);
                                    echo "<div class='rww'>";
                                    echo "<div><b>Subject : </b>{$row['ref_link']}";
                                    echo "<span style='float:right;margin-right: 10px;'>";
                                    if(iLikeIt($likes, $id_user)) echo "<font color=blue><i class='fa fa-heart' style='cursor:pointer' onclick='iDislikeThis({$row['id_link']})' title='Dislike'></i></font>";
                                    else echo "<font color='#ccc'><i class='fa fa-heart' style='cursor:pointer' onclick='iLikeThis({$row['id_link']})' title='Like it'></i></font>";
                                    echo " <label class='text text-blue'>$nblikes</label>&nbsp;&nbsp;";
                                    echo "</span>";
                                    echo "</div>
                                            <div><b>Title : </b> {$row['label_link']}</div>
                                            <div><b>Content : </b><br />
                                            <div style='padding:10px;'>" . str_replace("\n", "<br>", $row['comment']) . "</div></div>
                                            <div style='text-align: right'><i style='font-size: 12px'>By : {$row['prenom_user']} {$row['nom_user']}</i></div>";
                                    echo "</div>";
                                } if(mysqli_num_rows($res)<=0){
                                    echo "<tr><td align=center colspan=3><center>No public ToDos found</center></td></tr>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

<?php include("footer.php");?>

<script type="text/javascript">
function iLikeThis(idLink){
    $(".executer").load("public_todos.php?like="+idLink+" .setlike");
    updateView();
}

function iDislikeThis(idLink){
    $(".executer").load("public_todos.php?dislike="+idLink+" .setdislike");
    updateView();
}
    
function updateView(){
    $(".data-links").load("public_todos.php .data-links>*");
}
</script>