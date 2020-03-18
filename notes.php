<?php include("header.php");

if(isset($_POST['addlink'])){
    if($_POST['title']!="" || $_POST['link']!=""){
        $ispublic = isset($_POST['vis'])?1:0;
        $content = str_clean($_POST['desc']);
        $title = str_clean($_POST['title']);
        $subject = str_clean($_POST['link']);
        $rs = $conn->query("insert into links (label_link, ref_link, comment, id_user,visibility_link, is_todo) values ('$title', '$subject', '$content', $id_user, $ispublic, 1)");
        if($rs){
            if($ispublic){
                $rows = $conn->query("SELECT email_user FROM users WHERE id_user=10");
                $notifier = new EmailNotifier(1);
                $notifier->setFrom($conn->query("SELECT email_user FROM users WHERE id_user='$id_user'")->fetch_array()['email_user']);
                $notifier->setSubject("ToDo Published : " . $subject);
                $notifier->setMessage("<b>Title : </b> $title<br />$content");
                $notifier->retrieveHeaders();
                while($row = $rows->fetch_array()){
                    $notifier->setTo($row['email_user']);
                    $notifier->send();
                }
            }
        }
    }
}
?>

<div id="new_link" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Note</h4>
      </div>
      <form method="post">
          <div class="modal-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="link">Subject</label>
                    <input type="text" class="form-control" id="link" name="link" required>
                </div>
                <div class="form-group">
                    <label for="desc">Description</label>
                    <textarea type="text" class="form-control" id="desc" name="desc"></textarea>
                </div>
                <div class='checkbox'>
                    <input id='checkbox1' type='checkbox' name="vis">
                    <label for='checkbox1'><i class="fa fa-globe"></i> Set as public</label>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="addlink">Add</button>
          </div>
      </form>
    </div>

  </div>
</div>


<div class="setprivate">
<?php
if(isset($_GET['setprivate'])){
    if(! is_numeric($_GET['setprivate'])){
        die("Oh please, are you sure about this, get out of my face negga");
    }else{
        $conn->query("update links set visibility_link=0 where id_link={$_GET['setprivate']}");
    }
}
?>
</div>
<div class="setpublic">
<?php
if(isset($_GET['setpublic'])){
    if(! is_numeric($_GET['setpublic'])){
        die("Oh please, are you sure about this, get out of my face negga");
    }else{
        $conn->query("update links set visibility_link=1 where id_link={$_GET['setpublic']}");
    }
}
?>
</div>
<div class="dellink">
<?php
if(isset($_GET['dellink'])){
    if(! is_numeric($_GET['dellink'])){
        die("Oh please, are you sure about this, get out of my face negga");
    }else{
        $conn->query("delete from links where id_link={$_GET['dellink']}");
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
                                <h4 class="title">My ToDos <a href="#" class="pull-right" data-toggle="modal" data-target="#new_link"><i class='fa fa-plus'></i></a></h4>
                                <p class="category">Total of ToDos <b><?php echo $conn->query("SELECT count(*) as nb from links where id_user=$id_user and is_todo=1")->fetch_array()['nb'];?></b></p>
                            </div>
                            <div class="content table-responsive table-full-width data-links">
                                <?php
                                    $res = $conn->query("SELECT * from links where id_user=$id_user and is_todo=1 order by id_link desc");
                                    while($row = $res->fetch_array()){
                                        echo "<div class='rww'>";
                                        $visibility=$row['visibility_link']==0?"lock":"globe";
                                        echo "<div><b>Subject : </b>{$row['ref_link']}";
                                        echo "<span style='float:right;margin-right: 10px;'>";
                                            if($row['visibility_link']==0) echo "<a style='cursor:pointer;' onclick='setPublic({$row['id_link']})' title='set this link as public'><i class='fa fa-globe'></i></a>";
                                            else echo "<a style='cursor:pointer;' onclick='setPrivate({$row['id_link']})' title='set this link as private'><i class='fa fa-lock'></i></a>";
                                            echo "&nbsp;&nbsp;&nbsp;&nbsp;<a style='cursor:pointer;' onclick='delLink({$row['id_link']})' title='delete this link' class='text text-danger'><i class='fa fa-trash'></i></a>";
                                            echo "</span>";
                                        echo "</div>
                                            <div><b>Title : </b> {$row['label_link']}</div>
                                            <div><b>Content : </b><br />
                                            <div style='padding:10px;'>".str_replace("\n", "<br>", $row['comment'])."</div></div>
                                            <div style='text-align: right'><br /><i>visibility : </i><i class='fa fa-$visibility'></i></div>";
                                        echo "</div>";
                                    }
                                    if(mysqli_num_rows($res)<=0){
                                        echo "<tr><td align=center colspan=4><center><small>No ToDo found click the button above to add one</small></center></td></tr>";
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
function setPublic(id){
    $(".executer").load("notes.php?setpublic="+id+" .setpublic");
    updateView();
}

function setPrivate(id){
    $(".executer").load("notes.php?setprivate="+id+" .setprivate");
    updateView();
}

function delLink(id){
    if(confirm("Are you sure to delete this link?")){
        $(".executer").load("notes.php?dellink="+id+" .dellink");
        updateView();
    }
}

function updateView(){
    $(".data-links").load("notes.php .data-links>*");
    $(".category").load("notes.php .category");
}
    
$(document).ready(function(){
    $('#page_notes').attr('class', 'active');
})
</script>