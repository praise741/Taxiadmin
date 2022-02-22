<?php
 
class GCM {
 
    //put your code here
    // constructor
    function __construct() {
         
    }
 
    /**
     * Sending Push Notification
     */
    public function send_notification($tokens,$message,$data) {
        // include config
        include_once 'config.php';
 
        // Set POST variables
        $url='https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'registration_ids' 	=> $tokens,
            'notification' => $message,
            //'data'=>$data,
            'content_available' => true,
            'priority' => 'high',
            //'body'=>$data
        );

        $headers = array(
            'Authorization:key='.GOOGLE_API_KEY,
            'Content-Type:application/json'
        );
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, $url );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYHOST, 0 );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );

        $result = curl_exec($ch );
        //echo $result;
        if($result===FALSE){
            die('Curl Failed:'.curl_error($ch));
        }
        curl_close( $ch );

        return $result;
    }
 
}
 
?>
