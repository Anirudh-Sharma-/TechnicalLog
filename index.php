<?php
/*
 * icludes the file required for different functionalities
 */
require_once "lib/Smarty.class.php";
require_once "database.php";
//require_once "lib/plugins/export.php";
require_once "fpdf17/fpdf.php";
//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);

/*
 * FPDF library used for creating the pdf
 */
class PDF extends FPDF{
    function header(){
        $title = "Anirudh Sharma(Technical Log)";

        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Calculate width of title and position
        $w = $this->GetStringWidth($title)+6;
        $this->SetX((210-$w)/2);
        // Colors of frame, background and text
        $this->SetDrawColor(0,80,180);
        $this->SetFillColor(200,220,255);
        $this->SetTextColor(220,5,50);
        // Thickness of frame (1 mm)
        $this->SetLineWidth(1);
        // Title
        $this->Cell($w,9,$title,1,1,'C',true);
        // Line break
        $this->Ln(10);
    }
    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','B',8);
        $this->SetTextColor(128);
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
        
    }
    function notesTitle($note){
        $this->SetFont('Arial','B',12);
        $this->SetFillColor(200,220,255);
        $titleHead = $note['id']. "  " . $note['title']. "[Last modified: ". $note['last_modified'] . "]";
        $this->Cell(0,6,"$titleHead",0,1,'L',true);
        $this->Ln(4);
    
    }
    function notesContent($note){
        $this->SetFont('Times','',11);
        $this->MultiCell(0,5, $note['content']);
        $this->Ln();
        $this->SetFont('','I');
        $this->Cell(0,5,'(end of excerpt)');
   
    }
    function printNotes($note){
        $this->AddPage();
        $this->notesTitle($note);
        $this->notesContent($note);
    }
}

function createPdf(){
    $pdf = new PDF();
    $title = "Anirudh Sharma(Technical Log)";
    $pdf->SetTitle($title);
    $resultSet= fetchPdfData();
    foreach($resultSet as $note){
        $pdf->printNotes($note);
    }
    $pdf->Output();
}
/*
 * function for sending the mail
 */
function send_mail($params){
    $to = $params['address'];
    $subject = $params['subject'];
    $txt = $params['text'];
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: 19.anirudh.sharma@gmail.com' . "\r\n";
    
     
    if(mail($to,$subject,$txt,$headers)){
        global $mailSuccess;
        $mailSuccess = 1;
        $_COOKIE['message'] = $mailSuccess;

    }else{
        global $mailFailure;
        $mailFailure = 1;
        $_COOKIE['message'] = $mailFailure;
    }
}


/*
 * if some note is selected its id will be sent to ACTIVE_NOTE_ID,
 * otherwise it will get the maximum note id that is the last created note.
 */

if(!isValid($_COOKIE['ACTIVE_NOTE_ID'])) {
    setcookie("ACTIVE_NOTE_ID", getMaxId());
    $activeNoteId = getMaxId();
} else {
    $activeNoteId = $_COOKIE['ACTIVE_NOTE_ID'];
}


/*
 * switch case for different actions on index.php
 * delete: deletes the note
 * update: saves the modification of the note
 * new:    create new note
 * navigate: shows which  one is selected
 * pdf:     creates the pdf
 * share:   for sending mail
 */
switch($_REQUEST['action']) {
    case 'delete':
        deleteNote($activeNoteId);
        $newId = getMaxId();
        setcookie("ACTIVE_NOTE_ID", $newId);
        $activeNoteId = $newId;
        break;
    case 'update':
        updateNote($_COOKIE['ACTIVE_NOTE_ID'], $_REQUEST['title'], $_REQUEST['content']);
        break;
    case 'new':
        createNote("New note", "");
        $newId = getMaxId();
        global $new;       
        setcookie("ACTIVE_NOTE_ID", $newId);
        $activeNoteId = $newId;
        break;  
    case 'navigate':
        setcookie("ACTIVE_NOTE_ID", $_REQUEST['id']);
        $activeNoteId = $_REQUEST['id'];
        break;
    case 'pdf':
        createPdf();
        break;
    case 'share':
        $address = $_REQUEST['email'];
        $id = $_COOKIE['ACTIVE_NOTE_ID'];
        $resultSet = getNote($id);
        $text = $resultSet['content'];
        $subject = $resultSet['title'];
        $subject .= "[";
        $subject .= $resultSet['last_modified'];
        $subject .= "]";
        $params = array("address"=>"$address", "text"=>"$text", "subject"=>"$subject");
        send_mail($params);
        break;
}


/*
 * creates the new smarty object for sending 
 * the information fro this page to index.tpl
 */
$template = new Smarty();
//if(($_REQUEST['action']) == "new"){
 //  $template->assign('new', 'new');
//}
//if(($_REQUEST['message'])){
//   $template->assign('message', '$_SESSION["message"]');
//}

if($mailSuccess == 1){
    $template->assign('message','mail sent successfully!');
}
if($mailFailure == 1){
    $template->assign('message','mail cannot be sent successfully!');
}

$template->assign("ACTIVE_NOTE_ID", $activeNoteId);
$template->assign("notes", getNotes());
$template->display('index.tpl');
?>