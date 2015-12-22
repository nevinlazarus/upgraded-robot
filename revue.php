
<head>
        <link type="text/css" rel="stylesheet" href="http://cgi.cse.unsw.edu.au/~z5019263/revuemail/stylesheet.css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>  
		<title>Revue template</title>
</head>


<?php    
    //gets amount of body fields
    $n = max($_POST['count'], 1);   
    if ($_POST['Submit'] == "Add") {
        ++$n;
        $n = min($n, 5); 
    } else if ($_POST['Submit'] == "Remove") {
        --$n;
        $n = max($n, 1); 
    }    
    
    foreach($_POST as $key=>$value) {
        #DEBUG
        #echo "$key=$value"; 
    }
?>
<?php if(($_POST['Submit']) != "Submit"){ ?>
<body style="padding:25px;background-color:#add8e6"> 
 
    
    <form method="post">
    <?php
        writeTopPage();
    ?>
    <input type="hidden" name="count" value=<?php echo ($n) ?>>
    <div>
        
        <ol id="itemsList">
        <?php 
            for ($i = 0; $i < $n; ++$i) { 
                print_body_field($i);
            } 
        ?>
        </ol>
    </div>
    <div>
        <input type="hidden" value='<?php echo $n; ?>'>
        <input style="float:right" type="submit" value="Remove" name="Submit">        
        <input style="float:right" type="submit" value="Add" name="Submit">
    </div>
    </form>

    
</body>    
<?php } else { ?>
    
    <table class="background" cellspacing="0" cellpadding="10px" border="0" width="670px"><tbody><tr><td bgcolor="#EEEEEE">
    <table class="main" cellspacing="10px" cellpadding="10px">
        <!-- Header -->

        <tr><td bgcolor="#FFFFFF"><table cellpadding="0" cellspacing="0"><tbody><tr><td width="10px"></td><td width="100px"><img src="https://ci4.googleusercontent.com/proxy/Wxapk6V4nLI82PRoTYjku4EJW3Q4HhsH_vCu3r8PY60pr482XNqAOZCDOQgbdzmoFE7U9zfRW8fO=s0-d-e1-ft#http://cserevue.org.au/img/logo.png" width="90" height="46" style="margin-right:0px" class="CToWUd"><br></td><td width="490px">
        <h1 style="font-weight:normal;font-family:Verdana,sans-serif;margin:10px 0px 0px 10px;font-size:25px">
            <?php echo $_POST['headingInput'] ?>
        </h1>
        <h3 style="font-weight:normal;font-family:Verdana,sans-serif;margin:0px 0px 10px 10px;font-size:15px;color:rgb(68,68,68)">
            <?php echo $_POST['subheadingInput'] ?>
        </h3></td></tr></tbody></table></td></tr>
        <tr><td><p style="margin:0px 10px">
            <?php echo $_POST['greetingInput'] ?>
        </p></td></tr>
<?php 
    for ($i = 0; $i < $n; ++$i) { 
        print_body($i);
    } 
?>
        
        <tr id="footer"><td>
            <table cellspacing="0" cellpadding="0"><tbody><tr><td width="425px">
                <p id="signature">Nevin Lazarus | CSE Revue | Secretary <br>Tel: 9385 5880 | Email: <a href="mailto:secretary@cserevue.org.au">secretary@cserevue.org.au </a> <br>Web: <a href="http://www.cserevue.org.au" >http://www.cserevue.org.au </a> <br>CSE Revue Society, School of Computer Science &amp; Engineering, <br>K17 Building, University of New South Wales <br>Sydney, 2052 NSW</p>
            </td><td width="75px">
                <a href="https://www.facebook.com/groups/2244067967/" title="Facebook Group"><img src="img/facebook.gif" width="25px" height="25px"></a>
                <a href="https://www.facebook.com/cserevue" title="Facebook Page"><img src="img/like.gif" width="25px" height="25px"></a>
                <a href="http://www.cserevue.org.au/" title="Website"><img src="img/web.gif" width="25px" height="25px"></a>
                <a href="https://www.facebook.com/l.php?u=https%3A%2F%2Fwww.google.com%2Fcalendar%2Fembed%3Fsrc%3Davbg7c8bc9slfp0fhg9mkgqlck%2540group.calendar.google.com%26ctz%3DAustralia%252FSydney&h=JAQEew1Sg" title="Google Calendar"><img src="img/calendar.gif" width="25px" height="25px"></a>
            </td><td width="100px"> 
                <img src="img/arc_logo.gif" width="100px" height="72px">
            </td></tr></tbody></table>
        </td></tr>
    </tbody></table>
    </td></tr></tbody></table>
<?php } ?>


<?php
    function writeTopPage() {
        $myfile = fopen("header.html", "r") or die("Unable to open file!");
        echo fread($myfile,filesize("header.html"));
        fclose($myfile);
    }
    function print_body_field($i) {
        $file = fopen("body$i", "r");
        if (filesize("body$i")) {
            $body = fread($file, filesize("body$i"));
        }
        fclose($file);
        $file = fopen("head$i", "r");
        if (filesize("head$i")) {
            $head = fread($file, filesize("head$i"));
        }
        fclose($file);
        
        echo "<div class=\"myDiv\" style=\"width:100%\">
            <div id=\"div$i\">
                <select id=\"type$i\" name=\"type$i\">
                    <option value =\"announcement\">Announcement</option>
                    <option value =\"event\">Event</option>
                    <option value>(None)</option>
                </select>
            </div>
            <div>
            <input name=\"heading$i\" type='text' value='$head'>
            <textarea id=\"body$i\" name=\"body$i\">$body</textarea>
            </div>
        </div>";
    }
    
    function print_body($i) {
        $head = $_POST["heading$i"];
        $body = $_POST["body$i"];
        $file = fopen("body$i", "w");
        fwrite($file, $body);
        fclose($file);
        $file = fopen("head$i", "w");
        fwrite($file, $head);
        fclose($file);
        echo '<tr><td bgcolor="#FFFFFF" width="600px" style="border-left-width:5px;border-left-style:solid;border-left-color:rgb(102,102,255)">
                    <h2 style="font-weight:normal;font-family:Verdana,sans-serif;margin:10px;font-size:20px">';
        echo $_POST["heading$i"];
        echo '</h2><p style="margin:10px">';  
        $body = str_replace("\n", "</p><p style='margin:10px'>", "$body"); #keeps any newlines
        echo stripcslashes("$body"); #removes backslashes                
        echo '</p></td></tr>';
        
    }
?>
