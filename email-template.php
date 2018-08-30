<?php
    require_once '../libs/data/db.connect.php';
    require_once '../libs/data/db.paging.php';
    //Workings
    $caption="";
    $emailid=0;
    if(isset($_GET['emailid']) && $_GET['emailid']>0){
        $emailid=intval($_GET['emailid']);
    }
    if(isset($_POST['action']) && $_POST['action']=="EditEmailtemplate"){ //update email template
        $type="error";
        $emailid=intval($_POST['emailid']);
        $caption=trim($_POST['caption']);
        $cc=trim($_POST['mailcc']);
        $emailfrom=trim($_POST['mailfrom']);
        $namefrom=trim($_POST['namefrom']);
        $emailto=trim($_POST['mailto']);
        $subject=trim($_POST['mailsubject']);
        $mailbody=trim($_POST['mailbody']);
        $signature=trim($_POST['mailsignature']);
        $status=intval($_POST['status']);

        if($emailid > 0){
            $query="UPDATE emailtemplates SET caption='%s',namefrom='%s',mailfrom='%s',mailto='%s',mailsubject='%s',mailbody='%s',cc='%s',status='%s',mailsignature='%s',modificationdate=NOW() WHERE emailid=%i";
            $query=$sql->query($query,array($caption,$namefrom,$emailfrom,$emailto,$subject,$mailbody,$cc,$status,$signature,$emailid));
            if($db->query($query)){
                $type="success";
            }
        }
        echo '{"type":"' . $type . '"}';
        exit(0);
    }
    if(isset($emailid) && $emailid>0){
        $query="SELECT * FROM emailtemplates WHERE emailid=%i";
        $query=$sql->query($query,array($emailid));
        $result=$db->query($query);
        $count=$db->numRows($result);
        if($count==0){
            header("Location: email-templates.php");
            exit(0);
        }
        $row=$db->fetchNextObject($result);
        $caption=htmlentities($row->caption);
        $namefrom=$row->namefrom;
        $mailfrom=$row->mailfrom;
        $mailto=$row->mailto;
        $mailsubject=$row->mailsubject;
        $mailbody=$row->mailbody;
        $cc=$row->cc;
        $status=$row->status;
        $mailsignature=$row->mailsignature;
    }
    else
    {
        header("Location: email-templates.php");
        exit(0);
    }

    //Page Related data
    $page_title = "Email Template";
    $breadcrumb_array = array(
        array("caption"=>"Masters","link"=>"categories.php"),
        array("caption"=>"Email Templates","link"=>"email-templates.php"),
        array("caption"=>"Email Template","link"=>"")
    );
    $lm_masters = 1;
    $sm_email_templates = 1;
    include 'header.php';
?>
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="../ckfinder/ckfinder.js"></script>
    <script type="text/javascript" src="../jquery/swfobject.js"></script>
    <script type="text/javascript" src="js/email-template.js"></script>
    <form id="emailtemplateform" name="emailtemplateform" action="" method="post">
        <div class="padding20">
            <div id="notify"></div>
            <div align="right" class="required_field" style="padding-bottom: 5px;">* <?php echo _REQUIRED_FIELD_; ?></div>
            <div>
                <div class="border_left border_top border_right">
                    <input type="hidden" name="categoryid" id="categoryid" value="<?php echo $categoryid; ?>" />
                    <input type="hidden" name="action" id="action" value="<?php echo $action; ?>" />
                    <table cellpadding="0" cellspacing="0" border="0" class="list_table">
                        <tr>
                            <td align="left" valign="top" class="border_bottom border_right width15per">
                                <div class="padding20">
                                    <div class="form_label">Caption<span class="required_field"> *</span></div>
                                </div>
                            </td>
                            <td align="left" valign="top" class="border_bottom whitebg width85per">
                                <div class="padding20">
                                    <input type="text" name="caption" id="caption" value="<?php echo $caption;?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" class="border_bottom border_right width15per">
                                <div class="padding20">
                                    <div class="form_label">CC</div>
                                </div>
                            </td>
                            <td align="left" valign="top" class="border_bottom whitebg width85per">
                                <div class="padding20">
                                    <input type="text" name="mailcc" id="mailcc" value="<?php echo $cc;?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" class="border_bottom border_right width15per">
                                <div class="padding20">
                                    <div class="form_label">From<span class="required_field"> *</span></div>
                                </div>
                            </td>
                            <td align="left" valign="top" class="border_bottom whitebg width85per">
                                <div class="padding20">
                                    <input type="text" name="mailfrom" id="mailfrom" value="<?php echo $mailfrom; ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" class="border_bottom border_right width15per">
                                <div class="padding20">
                                    <div class="form_label">Name<span class="required_field"> *</span></div>
                                </div>
                            </td>
                            <td align="left" valign="top" class="border_bottom whitebg width85per">
                                <div class="padding20">
                                    <input type="text" name="namefrom" id="namefrom" value="<?php echo $namefrom;?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" class="border_bottom border_right width15per">
                                <div class="padding20">
                                    <div class="form_label">To<span class="required_field"> *</span></div>
                                </div>
                            </td>
                            <td align="left" valign="top" class="border_bottom whitebg width85per">
                                <div class="padding20">
                                    <input type="text" name="mailto" id="mailto" value="<?php echo $mailto;?>" >
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" class="border_bottom border_right width15per">
                                <div class="padding20">
                                    <div class="form_label">Subject<span class="required_field"> *</span></div>
                                </div>
                            </td>
                            <td align="left" valign="top" class="border_bottom whitebg width85per">
                                <div class="padding20">
                                    <input type="text" name="mailsubject" id="mailsubject" value="<?php echo $mailsubject;?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" class="border_bottom border_right width15per">
                                <div class="padding20">
                                    <div class="form_label">Mail Body<span class="required_field"> *</span></div>
                                </div>
                            </td>
                            <td align="left" valign="top" class="border_bottom whitebg width85per">
                                <div class="padding20">
                                    <textarea id="mailbody" name="mailbody" style="height:200px;" class="no-csform"><?php if($emailid>0){echo $mailbody;} ?></textarea>
                                </div>
                                <script type="text/javascript">
                                    CKEDITOR.replace( 'mailbody', {
                                        height:400,
                                        filebrowserBrowseUrl : '../ckfinder/ckfinder.html',
                                        filebrowserImageBrowseUrl : '../ckfinder/ckfinder.html?type=Images',
                                        filebrowserFlashBrowseUrl : '../ckfinder/ckfinder.html?type=Flash',
                                        filebrowserUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                        filebrowserImageUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                        filebrowserFlashUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                                    });
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" class="border_bottom border_right width15per">
                                <div class="padding20">
                                    <div class="form_label">Signature</div>
                                </div>
                            </td>
                            <td align="left" valign="top" class="border_bottom whitebg width85per">
                                <div class="padding20">
                                    <textarea id="mailsignature" name="mailsignature" style="height:200px;" class="no-csform"><?php if($emailid>0 && isset($mailsignature) && $mailsignature!=""){echo $mailsignature;} ?></textarea>
                                </div>
                                <script type="text/javascript">
                                    CKEDITOR.replace( 'mailsignature', {
                                        filebrowserBrowseUrl : '../ckfinder/ckfinder.html',
                                        filebrowserImageBrowseUrl : '../ckfinder/ckfinder.html?type=Images',
                                        filebrowserFlashBrowseUrl : '../ckfinder/ckfinder.html?type=Flash',
                                        filebrowserUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                        filebrowserImageUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                        filebrowserFlashUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                                    });
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" class="border_bottom border_right">
                                <div class="padding20">
                                    <div class="form_label">Status</div>
                                </div>
                            </td>
                            <td align="left" valign="top" class="border_bottom whitebg">
                                <div class="padding20">
                                    <?php
                                    $selectedstatus="selected='selected'";
                                    ?>
                                    <select name="status">
                                        <option value="1" <?php echo ($status==1)?$selectedstatus:""; ?>>Active</option>
                                        <option value="0" <?php echo ($status==0)?$selectedstatus:""; ?>>Inactive</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="border_left border_bottom border_right">
                    <div class="padding20">
                        <div>
                            <div class="pull_left btn34_sep">
                                <input id="submitbtn" type="submit" value="" class="btn34 btn34_save btn34_save_hover" />
                                <input type="hidden" name="emailid" id="emailid" value="<?php echo $emailid;?>" />
                                <input type="hidden" name="action" id="action" value="EditEmailtemplate" />
                            </div>
                            <div class="pull_left">
                                <input type="button" value="" class="btn34 btn34_cancel btn34_cancel_hover" onclick="javascript:cancelData()" />
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php include 'footer.php'; ?>