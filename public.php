<?php include("header.php");

$nblinks = $conn->query("SELECT count(*) as nb from links where visibility_link=1")->fetch_array()['nb'];

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
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Title</th>
                                    	<th>Description</th>
                                        <th>Publisher</th>
                                        <th>Likes</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        function iLikeIt($arr, $id){
                                            while($rr = $arr->fetch_array())
                                                if($rr['id_user'] == $id) return true;
                                            return false;
                                        }

                                        $res = $conn->query("SELECT * from links natural join users where visibility_link=1 order by id_link desc");
                                        while($row = $res->fetch_array()){
                                            $likes = $rs = $conn->query("select * from users natural join likes_of_links where id_link={$row['id_link']}");
                                            $nblikes = mysqli_num_rows($likes);
                                            echo "<tr>
                                                <td><a href='{$row['ref_link']}' target='_blank' title='Open this link'>{$row['label_link']}</a></td>
                                                <td>{$row['comment']}</td>
                                                <td>{$row['prenom_user']} {$row['nom_user']}</td>
                                                <td>";
                                                if(iLikeIt($likes, $id_user)) echo "<font color=blue><i class='fa fa-heart' style='cursor:pointer' onclick='iDislikeThis({$row['id_link']})' title='Dislike'></i></font>";
                                                else echo "<font color='#ccc'><i class='fa fa-heart' style='cursor:pointer' onclick='iLikeThis({$row['id_link']})' title='Like it'></i></font>";
                                               echo " <label class='text text-blue'>$nblikes</label></td>
                                            </tr>";
                                        }
                                        if(mysqli_num_rows($res)<=0){
                                            echo "<tr><td align=center colspan=3><center>No public links found</center></td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

<?php include("footer.php");?>

<script type="text/javascript">
function iLikeThis(idLink){
    $(".executer").load("public.php?like="+idLink+" .setlike");
    updateView();
}

function iDislikeThis(idLink){
    $(".executer").load("public.php?dislike="+idLink+" .setdislike");
    updateView();
}
    
function updateView(){
    $(".data-links").load("public.php .data-links>table");
}
</script>