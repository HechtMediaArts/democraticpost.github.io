<?php
/**
 * Simple contact form template for the Evolution Framework
 * Use it in a template for pages in WordPress
 * include it easily via  <?php $include_path = TEMPLATEPATH . '/inc/includes/'; require ($include_path . 'contact-form.php'); ?>
 * 
 * @author Andreas Hecht
 * @version 04.04.2013
 * @package Evolution Framework
 * @subpackage Template
*/

// start config
$empfaenger= get_option('admin_email');

// Anti spam sentence for md5 encryption.
$unique_str='kY1$<HN:A)k36Ns-z|P!/7ff+D}<0!+)4zCQdrI(|.*+YElvoFAh$G|n0:PRLi0A_3_0P-5/s>#S -C(;Y<~)b;alV{A`CMBv$Xmk|H,I|Q:py%1cM53&KBx/c|~W6+zx8U-Ve5l[2rD;s|+]G+0TvNRa#W*TR1gyk.Y`AS4sR(pE{PQ5#li]dmD7u/3@o5~AkY1$<HN:A)k36Ns-z|P!/7ff+D}<0!+)4zCQdrI(|.*+YElvoFAh$G|n0:PRLi0A_3_0P-5/s>#S -C(;Y<~)b;alV{A`CMBv$Xmk|H,I|Q:py%1cM53&KBx/c|~W6+zx8U-Ve5l[2rD;s|+]G+0TvNRa#W*TR1gyk.Y`AS4sR(pE{PQ5#li]dmD7u/3@o5~A';

// Building the array
$felder=array( __("Name", "revothemes"),__("E-Mail", "revothemes"), __("Betreff", "revothemes"), __("Nachricht", "revothemes") );
// Rquired fields (not empty)
$felder_pflicht=array( __("Name", "revothemes"), __("E-Mail", "revothemes"), __("Nachricht", "revothemes") );
// All fields that needs a textarea
$felder_textarea=array(__("Nachricht", "revothemes"));
// checkbox-fields
$felder_checkbox=array('ring-back requested');
// radio-fields
//$felder_radio=array('Anrede'=>array('Herr','Frau'));
// dropdown-field
//$felder_dropdown=array('Anrede'=>array('Herr','Frau'));


// Building the subject
$theme_data = wp_get_theme();
$name=$theme_data['Name'];

// subject of the email (field-name or fixed subject)
$felder_betreff= __('Kontaktformular Nachricht von ', 'revothemes').$name;;
// sender of the email (field-name or fixed email-address)
$felder_absender=__("E-Mail", "revothemes"); // DO NOT EDIT THIS FIELD!!!!!!!!!!!

// check function
function check ($feld)
 {
 global $value;
 if($feld==__("E-Mail", "revothemes"))
  {
  if (eregi("^[a-z0-9]+([-_\.]?[a-z0-9])+@[a-z0-9]+([-_\.]?[a-z0-9])+\.[a-z]{2,4}", $value[$feld])) return true;
  else return false;
  }
 else return true;
 }

// End config
$gesendet=false;

// days dependent key
$antispam_str=$unique_str.date('d.m.Y');

if(date('H')=='00')
 {
 // It is 0 clock. Maybe someone has sent before 0 clock the form. Therefore, the key is accepted from yesterday.
 $antispam_str2=$unique_str.date('d.m.Y',time()-86400);
 }
else $antispam_str2=$antispam_str;


$allesda=true;
$pflicht_fehlt=array();
$value=array();

// catch all fields
foreach($felder as $feld)
 {
 // generate keys
 $feld_key[$feld]=md5($feld.$antispam_str);
 $feld_key2[$feld]=md5($feld.$antispam_str2);

 // Check whether data were sent
 if(!isset($_POST[$feld_key[$feld]]))
  {
  if(!isset($_POST[$feld_key2[$feld]]))
   {
   // Field is not sent
   if(!in_array($feld,$felder_checkbox)) $allesda=false;
   }
  else
   {
   // Field sent with key2, value read
   $value[$feld]=$_POST[$feld_key2[$feld]];
   }
  }
 else
  {
  // Field sent with key1, value read
  $value[$feld]=$_POST[$feld_key2[$feld]];
  }

 // If required: check if empty
 if(in_array($feld,$felder_pflicht) && empty($value[$feld])) $pflicht_fehlt[]=$feld;
 }

if($allesda)
 {
 // It sent all fields
 if(!empty($pflicht_fehlt))
  {
  // a required field was not specified
    echo '<p class="alert">';
    echo  _e('FEHLER: Sie haben folgende Felder (Feld) vergessen auszufüllen: ', 'revothemes');
  foreach($pflicht_fehlt as $feld) echo $feld." ";
  echo "</p>";
  }
 else
  {
  // test function apply
  $check_ok=true;
  foreach($felder as $feld)
   {
   if(!check($feld))
    {
    echo '<p class="alert">';
    echo _e('FEHLER: Das folgende Feld ist ungültig: ', 'revothemes');
    echo $feld . "</p>";
    $check_ok=false;
    }
   }

  if($check_ok)
   {
   // Building the message
   $nachricht="";
   foreach($felder as $feld)
    {
    $nachricht.=$feld.': '.(in_array($feld,$felder_textarea)?"\n":'').$value[$feld]."\n";
    }
    if(isset($value[$felder_absender])) $absender=$value[$felder_absender]; // Sender field
   else $absender=$felder_absender; // fixed sender
   if(isset($value[$felder_betreff])) $betreff=$value[$felder_betreff]; // subject field
   else $betreff=$felder_betreff; // fixed subject

   // send mail
   @mail($empfaenger,$betreff,$nachricht,'From: '.$absender)
   or die ("<p><a href='javascript:history.back()'>".__("FEHLER: Die E-Mail konnte nicht gesendet werden", "revothemes")."</a></p>");
   echo "<p class='success_message'>".__("Die Nachricht wurde erfolgreich versendet. Vielen Dank!", 'revothemes')."</p>";
   $gesendet=true;
   }
  }
 }

// Function to "encrypt" the field identifier in ASCII
function ascii_encode($str)
 {
 $ascii="";
 for ($i=0; $i < strlen($str); $i++) $ascii .= '&#'.ord($str[$i]).';';
 return $ascii;
 }

if(!$gesendet)
 {
  ?>

<div id="contactform">
  <form action="<?php the_permalink(); ?>" method="post">

  <?php
  foreach($felder as $feld)
   {
   // Generate HTML form field
   ?>

    <div class="cform"><?php echo ascii_encode($feld).(in_array($feld,$felder_pflicht)?' *':''); ?></div>

    <?php
    if(in_array($feld,$felder_textarea))
     {
     // a textarea field
     echo '<div class="cform"><textarea name="'.$feld_key[$feld].'" rows="5" cols="20">'.(isset($value[$feld])?htmlentities(strip_tags($value[$feld])):'').'</textarea></div>';
     }
    elseif(in_array($feld,$felder_checkbox))
     {
     // a checkbox field
     echo '<div class="cform"><input type="checkbox" name="'.$feld_key[$feld].'"'.(isset($value[$feld]) && $value[$feld]?'checked="checked"':'').' /></div>';
     }
    elseif(isset($felder_radio[$feld]))
     {
     // a radio field
     foreach($felder_radio[$feld] as $eintrag)
      {
      echo '<div class="cform"><input type="radio" name="'.$feld_key[$feld].'" value="'.$eintrag.'" '.(isset($value[$feld]) && $value[$feld]==$eintrag?'checked="checked"':'').' /></div> '.$eintrag.'<br />';
      }
     }
    elseif(isset($felder_dropdown[$feld]))
     {
     // a drop-down field
     echo '<div class="cform"><select name="'.$feld_key[$feld].'">';
     foreach($felder_dropdown[$feld] as $eintrag)
      {
      echo '<option value="'.$eintrag.'" '.(isset($value[$feld]) && $value[$feld]==$eintrag?'selected="selected"':'').' /> '.$eintrag.'</option>';
      }
     echo '</select></div>';
     }   else
     {
     // a text field => input type="text"
     echo '<div class="cform"><input type="text" name="'.$feld_key[$feld].'" value="'.(isset($value[$feld])?htmlentities(strip_tags($value[$feld])):'').'" /></div>';
     }
    ?>

   <?php
   }
  ?>
  <div class="button">
  <input type="submit" value="<?php _e('Nachricht senden', 'revothemes'); ?>" onclick="return confirm( '<?php print esc_js( __( 'Clicking on OK will send your message.', 'revothemes' ) ); ?>' );" />
    </div>
  </form>
</div> <!-- end div #contactform -->
<?php }