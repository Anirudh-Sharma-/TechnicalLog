<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-25 13:07:52
         compiled from "./templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3954121205512fbe88f1570-58561247%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e6296dbaed27222a9f456d3da542362e939111d' => 
    array (
      0 => './templates/index.tpl',
      1 => 1427311838,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3954121205512fbe88f1570-58561247',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5512fbe8ac1583_87550852',
  'variables' => 
  array (
    'notes' => 0,
    'note' => 0,
    'ACTIVE_NOTE_ID' => 0,
    'message' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5512fbe8ac1583_87550852')) {function content_5512fbe8ac1583_87550852($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/anirudh/public_html/journal/lib/plugins/modifier.date_format.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"miNotes"), 0);?>


<div id="container">
     
    <div id="notes-list">
        <div id="notes-list-header" class="header">
            <span class="left">mINotes</span>
            <span class="right"><a href="index.php?action=new"><img src="images/CreateNote.png" alt="Create new note."></a></span>
        </div>
        <?php  $_smarty_tpl->tpl_vars['note'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['note']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['notes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['note']->key => $_smarty_tpl->tpl_vars['note']->value) {
$_smarty_tpl->tpl_vars['note']->_loop = true;
?>
            <div class="notes-list-item <?php if ($_smarty_tpl->tpl_vars['note']->value['id']==$_smarty_tpl->tpl_vars['ACTIVE_NOTE_ID']->value) {
echo 'active';
}?>">
                <span class="notes-list-item-title"><a href="index.php?action=navigate&id=<?php echo $_smarty_tpl->tpl_vars['note']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['note']->value['title'];?>
</a></span>
                <span class="notes-list-item-timestamp"><a href="index.php?action=navigate&id=<?php echo $_smarty_tpl->tpl_vars['note']->value['id'];?>
"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['note']->value['last_modified'],"%b %d");?>
</a></span>
            </div>      
        <?php } ?>
    </div>
    
    <div id="notepad">
        <div id="notepad-header" class="header">
            
            <span><a href="#" onclick="document.getElementById('updateForm').submit();">Save</a></span>&nbsp;|&nbsp;<span><a href="index.php?action=pdf">Create PDF</a></span>&nbsp;|&nbsp;<span><a href="index.php?action=delete" onclick="return confirm('Are you sure?');">Delete</a></span>
            <span class="right">Anirudh Sharma</span>
            <br/>
            
        </div>
        
        <div>
    
            <?php  $_smarty_tpl->tpl_vars['note'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['note']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['notes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['note']->key => $_smarty_tpl->tpl_vars['note']->value) {
$_smarty_tpl->tpl_vars['note']->_loop = true;
?>
                <?php if ($_smarty_tpl->tpl_vars['note']->value['id']==$_smarty_tpl->tpl_vars['ACTIVE_NOTE_ID']->value) {?>
                <span id="timestamp"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['note']->value['last_modified'],"%B %d, %r");?>
</span>
                <form action="index.php" method="POST" id="updateForm">
                    <div id="tinymce-holder">
                        <span class="label">Enter Title:</span> <input type = "text" name = "title" value = "<?php echo $_smarty_tpl->tpl_vars['note']->value['title'];?>
"/><br/>
                        <textarea rows="20" cols="80"  name="content" style="margin: 20px;"><?php echo $_smarty_tpl->tpl_vars['note']->value['content'];?>
</textarea>
                    </div>  
                    <input type="hidden" name="action" value="update"/>
                </form>
                <?php }?>
            <?php } ?>
          
        </div>
        <div >
             
          &nbsp;
          <form action = "index.php?action=share" method="POST">
                <br/>
                &nbsp;
                E-mail:&nbsp;
                <input type="email" name="email" value="">
                &nbsp;
                <span><input type="submit" value="share" name = "action" /></span>
           </form>
          &nbsp;
          <div>
          <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

         </div>
           
          
    </div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php }} ?>
