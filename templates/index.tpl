{include file="header.tpl" title="miNotes"}

<div id="container">
    {*displays the notes list on the left of the page*} 
    <div id="notes-list">
        <div id="notes-list-header" class="header">
            <span class="left">mINotes</span>
            <span class="right"><a href="index.php?action=new"><img src="images/CreateNote.png" alt="Create new note."></a></span>
        </div>
        {foreach from=$notes item=note}
            <div class="notes-list-item {if $note.id eq $ACTIVE_NOTE_ID}{'active'}{/if}">
                <span class="notes-list-item-title"><a href="index.php?action=navigate&id={$note.id}">{$note.title}</a></span>
                <span class="notes-list-item-timestamp"><a href="index.php?action=navigate&id={$note.id}">{$note.last_modified|date_format:"%b %d"}</a></span>
            </div>      
        {/foreach}
    </div>
    
    <div id="notepad">
        <div id="notepad-header" class="header">
            {*displays the button on the top of the main section*}
            <span><a href="#" onclick="document.getElementById('updateForm').submit();">Save</a></span>&nbsp;|&nbsp;<span><a href="index.php?action=pdf">Create PDF</a></span>&nbsp;|&nbsp;<span><a href="index.php?action=delete" onclick="return confirm('Are you sure?');">Delete</a></span>
            <span class="right">Anirudh Sharma</span>
            <br/>
            
        </div>
        
        <div>
   {*displays the place for writing note, the date and title of note*} 
            {foreach from=$notes item=note}
                {if $note.id eq $ACTIVE_NOTE_ID}
                <span id="timestamp">{$note.last_modified|date_format:"%B %d, %r"}</span>
                <form action="index.php" method="POST" id="updateForm">
                    <div id="tinymce-holder">
                        <span class="label">Enter Title:</span> <input type = "text" name = "title" value = "{$note.title}"/><br/>
                        <textarea rows="20" cols="80"  name="content" style="margin: 20px;">{$note.content}</textarea>
                    </div>  
                    <input type="hidden" name="action" value="update"/>
                </form>
                {/if}
            {/foreach}
          
        </div>
        <div >
            {*display the mail functionality*} 
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
          {$message}
         </div>
           
          
    </div>
</div>

{include file="footer.tpl"}

