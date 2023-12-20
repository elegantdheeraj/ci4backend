<?php
namespace App\Libraries;
use App\Models\OtpRequestsModel;
use Exception;
class Sms {
    protected $senderId;
    public function send($mobile, $message, $lng = 'E')
    {
        if(!$this->senderId) {
            $this->senderId = env('v_sender_id');
        }
        $url = env('v_sms_host');
        $username = env('v_sms_username');
        $password = env('v_sms_password');
        $senderId = $this->senderId;
        $sendData = array(
            '@VER' => '1.2',
            'USER' => array(
                '@USERNAME' => $username,
                '@PASSWORD' => $password,
            ),
            'DLR' => array(
                '@URL' => $url
            ),
            'SMS' => array(
                array(
                    '@UDH'      => "0",
                    '@CODING'   => "1",
                    '@PROPERTY' => "0",
                    '@ID'       => (string) date('YMD').rand(100,999),
                    'ADDRESS'   => array(
                        array(
                            '@FROM' => $senderId,
                            '@TO'   => (string) "91".$mobile,
                            '@SEQ'  => "0",
                            '@TAG'  => (string) $mobile
                        )
                    ),
                    '@TEXT' => $message
                )
            )
        );
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($sendData));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
        curl_setopt($curl, CURLOPT_USERAGENT, $senderId);
        try {
            $response = curl_exec($curl); 
            if (curl_errno($curl) || (string) $response == 'Forbidden') {
                // $error_msg = curl_error($curl);
                return false;
            }
            $response = json_decode($response, true);
            
            if(isset($response['MESSAGEACK']['GUID']['ERROR'])) {
                // error_msg =  $response['MESSAGEACK']['GUID']['ERROR']['CODE'];
                return false;
            } 
            // GUID =  $response['MESSAGEACK']['GUID']['GUID'];
            return true;
        } catch(Exception $e) {
            // error_msg =  $e->getMessage();
            return false;
        }
    }
    public function get_otp($data = array())
    {
        $res = array();
        $res['status'] = false;
        $otp = rand(100000,999999);
        $model = new OtpRequestsModel();
        if(isset($data['mobile'])) {
            $model->where('mobile', $data['mobile']);
            $query_data = $model->first();
            if(empty($query_data)) {
                $insert_data = array(
                    'mobile' => isset($data['mobile']) ? $data['mobile'] : '',
                    'ip'     => isset($data['ip']) ? $data['ip'] : '',
                    'otp'    => $otp
                );
                if(!$model->save($insert_data)) {
                    $res['message'] = "Falied to add info";
                    return false;
                }
            }  else {
                $model->set('otp', $otp);
                $model->where('id', $query_data['id']);
                $model->update();
            }
            return $otp;
        } 
        return false;
    }
    public function verify_otp($mobile, $otp)
    {
        $model = new OtpRequestsModel();
        $query_result = $model->where('mobile', $mobile)->where('otp', $otp)->first();
        if($query_result) {
            return true;
        } 
        return false;
    }
}