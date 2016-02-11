<?php
/**
 * Created by PhpStorm.
 * User: yassir alharbi
 * Date: 5/06/15
 * Time: 2:08 AM
 * this file is used for shared functions and also used to connect to the database 
 */
/**************************************
Connect to the database
***************************************/
function connect()
{
    $connect = mysql_connect("localhost", "root", "root")
    or die( "ERROR: Connection failed ");

    $sel = mysql_select_db("CSLc_Tutoring_System");
    if(!$sel)
        exit("Error: Could not select database!");

    return $connect;
}

/**************************************
Get array list for ENUM or SET options
 ***************************************/
function getOptions($sql)
{
    $connect = connect();
    $query = mysql_query($sql);
    $row = mysql_fetch_object($query);
    $setOptions = preg_replace("/(enum|set)\('(.+?)'\)/","\\2", $row->Type);
    $options = explode("','", $setOptions);
    mysql_close($connect);
    return $options;
}
//function trim_all( $str , $what = NULL , $with = ' ' )
//{
//    if( $what === NULL )
//    {
//        //	Character      Decimal      Use
//        //	"\0"            0           Null Character
//        //	"\t"            9           Tab
//        //	"\n"           10           New line
//        //	"\x0B"         11           Vertical Tab
//        //	"\r"           13           New Line in Mac
//        //	" "            32           Space
//
//        $what	= "\\x00-\\x20";	//all white-spaces and control chars
//    }
//
//    return trim( preg_replace( "/[".$what."]+/" , $with , $str ) , $what );
//}
//sanitize function


function cleanInput($input) {

    $search = array(
        '@<script[^>]*?>.;*?</script>@si',   // Strip out javascript
        '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
        '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
        '@<![\s\S]*?--[ \t\n\r]*>@',         // Strip multi-line comments
        // '@select|insert|and|or|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile@'
    );

    $output = preg_replace($search, '', $input);
    return $output;
}

function sanitize($input) {
    $i=strlen($input);
    $i=$i/5;

    while ($i>=0) {
        if (is_array($input)) {
            foreach ($input as $var => $val) {
                $output[$var] = sanitize($val);
            }
        } else {
            if (get_magic_quotes_gpc()) {
                $input = stripslashes($input);
            }
            $input = cleanInput($input);
            $output = mysql_real_escape_string($input);
        }
        $i--;
    }


    return $output;
}

//
//function Sanitize_In($data,$ignore_magic_quotes=false)
//{
//    if(is_string($data))
//    {
//        $data=trim(htmlspecialchars($data));
//        if(($ignore_magic_quotes==true)||(!get_magic_quotes_gpc()))
//        {
//            $data = addslashes($data);
//        }
//        return  $data;
//    }
//    else if(is_array($data))
//    {
//        foreach($data as $key=>$value)
//        {
//            $data[$key]=in($value);
//        }
//        return $data;
//    }
//    else
//    {
//        return $data;
//    }
//}

function security($input)
{
    $input = mysql_real_escape_string($input);
    $input = strip_tags($input);
    $input = stripslashes($input);
    return $input;
}

function getCheck($value){
    strtolower($value);

    $array = array(
        "union",
        "sql",
        "mysql",
        "database",
        "cookie",
        "coockie",
        "select",
        "from",
        "where",
        "benchmark",
        "concat",
        "table",
        "into",
        "by",
        "limit",
        "all",
        "values",
        "exec",
        "shell",
        "truncate",
        "wget",
        "/**/",
        "0x3a",
        "password",
        "-9999999",
        "1,2,3,4,",
        "999",
        "1,2,3,4,5,6,7,8,0,999,",
        "1,2,3,4,5,6,7,8,0,999",
        "BUN",
        "char",
        "S@BUN",
        "null",
        "'%",
        "OR%"

    );

    if(in_array($value, $array)){
        echo"Gotcha";
        exit;

    }
    return$value;
}


function hash_finder($input)

{
    $connect = connect();

    $sql = "SELECT get_hash FROM tutors WHERE  tutor_Id = '$input';";
    $query= mysql_query( $sql, $connect );

    while($row = mysql_fetch_object($query))
    {

        $old_hash = $row->get_hash;


    }


    return $old_hash;
}

function hash_changer($input)
{

    $get_hash = crypt(uniqid(crypt(uniqid($input))));

    $sql = "UPDATE tutors  SET get_hash = '$get_hash' WHERE  tutor_Id = '$input';";
    $query = mysql_query($sql, $connect);


}
function hash_finder_do($input)

{
    $connect = connect();

    $sql = "SELECT tutor_Id FROM tutors WHERE  get_hash = '$input';";
    $query= mysql_query( $sql, $connect );

    while($row = mysql_fetch_object($query))
    {

        $tutor_Id = $row->tutor_Id;

        $get_hash = crypt(uniqid(crypt(uniqid($input))));

        $sql = "UPDATE tutors  SET get_hash = '$get_hash' WHERE  tutor_Id = '$tutor_Id';";
        $query = mysql_query($sql, $connect);

    }


    return $tutor_Id;

}
function job_hash_finder($input)

{
    $connect = connect();

    $sql = "SELECT get_hash FROM job-Booked WHERE  book_Id = '$input';";
    $query= mysql_query( $sql, $connect );

    while($row = mysql_fetch_object($query))
    {

        $old_hash = $row->get_hash;


    }


    return $old_hash;
}

function job_hash_changer($input)
{

    $get_hash = crypt(uniqid(crypt(uniqid($input))));

    $sql = "UPDATE job-Booked  SET get_hash = '$get_hash' WHERE  book_Id = '$input';";
    $query = mysql_query($sql, $connect);


}
function job_hash_finder_do($input)
{
    $connect = connect();
    //echo"$input";
    $sql = "SELECT * FROM `job-Booked` WHERE get_hash = '$input '";

    $query= mysql_query($sql, $connect);
    if(!mysql_query($sql,$connect))
    {
        echo "<br/>";
        echo "<br/>";
        die('Error: ' . mysql_error());
        echo "<br/>";echo "<br/>";
    }
    while($row = mysql_fetch_object($query))
    {
        $bookId = $row->book_Id;
    }

    $input= hash_changer($bookId);
    return $bookId;
}


function events_hash_finder($input)

{
    $connect = connect();

    $sql = "SELECT get_hash FROM events WHERE  event_Id = '$input';";
    $query= mysql_query( $sql, $connect );

    while($row = mysql_fetch_object($query))
    {

        $old_hash = $row->get_hash;


    }


    return $old_hash;
}

function events_hash_changer($input)
{

    $get_hash = crypt(uniqid(crypt(uniqid($input))));

    $sql = "UPDATE events SET get_hash = '$get_hash' WHERE  event_Id = '$input';";
    $query = mysql_query($sql, $connect);


}
function events_hash_finder_do($input)

{
    $connect = connect();

    $sql = "SELECT * FROM events WHERE get_hash= '$input';";

    $query= mysql_query( $sql, $connect );

    while($row = mysql_fetch_object($query))
    {

        $event_Id = $row->event_Id;


    }

    $input= hash_changer($event_Id);
    return $event_Id;
}



function courses_hash_finder($input)

{
    $connect = connect();

    $sql = "SELECT get_hash FROM courses WHERE  corse_Id = '$input';";
    $query= mysql_query( $sql, $connect );

    while($row = mysql_fetch_object($query))
    {

        $old_hash = $row->get_hash;


    }


    return $old_hash;
}

function courses_hash_changer($input)
{
    $connect = connect();

    $get_hash = crypt(uniqid(crypt(uniqid($input))));

    $sql = "UPDATE courses SET get_hash = '$get_hash' WHERE  corse_Id = '$input';";
    $query = mysql_query($sql, $connect);


}


function courses_hash_finder_do($input)

{
    $connect = connect();

    $sql = "SELECT corse_Id FROM courses WHERE  get_hash = '$input';";
    $query = mysql_query($sql, $connect);

    while ($row = mysql_fetch_object($query)) {

        $corse_Id = $row->corse_Id;


    }

    $input = hash_changer($corse_Id);
    return $corse_Id;
}



function languages_hash_finder($input)

{
    $connect = connect();

    $sql = "SELECT get_hash FROM Languages WHERE  Language = '$input';";
    $query= mysql_query( $sql, $connect );

    while($row = mysql_fetch_object($query))
    {

        $old_hash = $row->get_hash;


    }


    return $old_hash;
}

function languages_hash_changer($input)
{
    $connect = connect();

    $get_hash = crypt(uniqid(crypt(uniqid($input))));

    $sql = "UPDATE Languages SET get_hash = '$get_hash' WHERE  language = '$input';";
    $query = mysql_query($sql, $connect);


}


function languages_hash_finder_do($input)

{
    $connect = connect();

    $sql = "SELECT language FROM Languages WHERE  get_hash = '$input';";
    $query = mysql_query($sql, $connect);

    while ($row = mysql_fetch_object($query)) {

        $language = $row->language;


    }

    $input = hash_changer($language);
    return $language;
}
// Step 1 - we need a connection to the ldap server
$ws_ldap_connection = null ;
function ecms_ldap_search($filter,$base="dc=adelaide,dc=edu,dc=au")
{
        global $ws_ldap_connection ;

        $oops = array('count'=>0) ;
        if ( $ws_ldap_connection == null )
        {
                $r = ldap_connect("ldaps://ldap.adelaide.edu.au") ;
                if ( $r === FALSE ) return $oops ;
                $ws_ldap_connection = $r ;
        }

        $r = @ldap_search($ws_ldap_connection,$base,$filter) ;
        //ecms_print_r(ldap_error($ws_ldap_connection)) ;
        if ( $r === FALSE ) return $oops ;

        $r = @ldap_get_entries($ws_ldap_connection,$r) ;
        if ( $r === FALSE ) return $oops ;
        return $r ;
}

// Username lookup - get the real name for the username
function ecms_ldap_uid_lookup($username)
{
        $r = ecms_ldap_search("(uid=$username)") ;
        if ( $r['count'] == 0 ) return array('uid'=>$username,'firstname'=>'?','surname'=>'?','name'=>'?','email'=>'') ;
        $uid = $r[0]["uid"][0] ;
        $givenname = $r[0]["givenname"][0] ;
        if ( isset($r[0]["auedupersonpreferredgivenname"][0]) )
        {
                $givenname = $r[0]["auedupersonpreferredgivenname"][0] ;
        }
        $surname = $r[0]["sn"][0] ;
        if ( isset($r[0]["auedupersonpreferredsurname"][0]) )
        {
                $surname = $r[0]["auedupersonpreferredsurname"][0] ;
        }
        $name = $r[0]["cn"][0] ;
        $email = $r[0]["mail"][0] ;
        return ecms_ldap_user_sanitise(array('uid'=>$uid,'firstname'=>$givenname,'surname'=>$surname,'name'=>$name,'email'=>$email)) ;
}

// Ldap entry lookup - get the ldap entry for the username
function ecms_ldap_user_lookup($username)
{
        $r = ecms_ldap_search("(uid=$username)") ;
        return $r['count'] == 0 ? array() : $r[0] ;
}

function admin_hash_finder_do($input)

{
    $connect = connect();

    $sql = "SELECT admin_id FROM Admins WHERE  get_hash = '$input';";
    $query= mysql_query( $sql, $connect );

    while($row = mysql_fetch_object($query))
    {

        $admin_id = $row->admin_id;



    }


    return $admin_id;

}





?>