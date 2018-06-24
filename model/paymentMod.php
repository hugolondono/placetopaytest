<?php

class paymentMod {

    private $pay_bank;
    private $pay_bank_type;
    private $pay_document;
    private $pay_document_type;
    private $pay_first_name;
    private $pay_last_name;
    private $pay_company;
    private $pay_email_address;
    private $pay_address;
    private $pay_city;
    private $pay_province;
    private $pay_country;
    private $pay_phone;
    private $pay_mobile;
    private $seed;
    private $tran_key;
    private $pay_ip_address;
    private $pay_user_agent;
    private $status;
    private $message;
    private $result;
    private $objDao;

    function __construct() {

        include_once '../configs/config.php';
        $this->pay_bank = '';
        $this->pay_bank_type = '';
        $this->pay_document = '';
        $this->pay_document_type = '';
        $this->pay_first_name = '';
        $this->pay_last_name = '';
        $this->pay_company = '';
        $this->pay_email_address = '';
        $this->pay_address = '';
        $this->pay_city = '';
        $this->pay_province = '';
        $this->pay_country = '';
        $this->pay_phone = '';
        $this->pay_mobile = '';
        $this->seed = date('c');
        $this->tran_key = sha1($this->seed . KEY, false);
        $this->pay_ip_address = $_SERVER['SERVER_ADDR'];
        $this->pay_user_agent = $_SERVER['HTTP_USER_AGENT'];
        $this->status = '';
        $this->message = '';
        $this->result = '';

        include_once '../dao/paymentDao.php';
        $this->objDao = new paymentDao();
    }

    function getPay_bank() {
        return $this->pay_bank;
    }

    function getPay_bank_type() {
        return $this->pay_bank_type;
    }

    function getPay_document() {
        return $this->pay_document;
    }

    function getPay_document_type() {
        return $this->pay_document_type;
    }

    function getPay_first_name() {
        return $this->pay_first_name;
    }

    function getPay_last_name() {
        return $this->pay_last_name;
    }

    function getPay_company() {
        return $this->pay_company;
    }

    function getPay_email_address() {
        return $this->pay_email_address;
    }

    function getPay_address() {
        return $this->pay_address;
    }

    function getPay_city() {
        return $this->pay_city;
    }

    function getPay_province() {
        return $this->pay_province;
    }

    function getPay_country() {
        return $this->pay_country;
    }

    function getPay_phone() {
        return $this->pay_phone;
    }

    function getPay_mobile() {
        return $this->pay_mobile;
    }

    function getStatus() {
        return $this->status;
    }

    function getMessage() {
        return $this->message;
    }

    function getResult() {
        return $this->result;
    }

    function getObjDao() {
        return $this->objDao;
    }

    function setPay_bank($pay_bank) {
        $this->pay_bank = $pay_bank;
    }

    function setPay_bank_type($pay_bank_type) {
        $this->pay_bank_type = $pay_bank_type;
    }

    function setPay_document($pay_document) {
        $this->pay_document = $pay_document;
    }

    function setPay_document_type($pay_document_type) {
        $this->pay_document_type = $pay_document_type;
    }

    function setPay_first_name($pay_first_name) {
        $this->pay_first_name = $pay_first_name;
    }

    function setPay_last_name($pay_last_name) {
        $this->pay_last_name = $pay_last_name;
    }

    function setPay_company($pay_company) {
        $this->pay_company = $pay_company;
    }

    function setPay_email_address($pay_email_address) {
        $this->pay_email_address = $pay_email_address;
    }

    function setPay_address($pay_address) {
        $this->pay_address = $pay_address;
    }

    function setPay_city($pay_city) {
        $this->pay_city = $pay_city;
    }

    function setPay_province($pay_province) {
        $this->pay_province = $pay_province;
    }

    function setPay_country($pay_country) {
        $this->pay_country = $pay_country;
    }

    function setPay_phone($pay_phone) {
        $this->pay_phone = $pay_phone;
    }

    function setPay_mobile($pay_mobile) {
        $this->pay_mobile = $pay_mobile;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setMessage($message) {
        $this->message = $message;
    }

    function setResult($result) {
        $this->result = $result;
    }

    function setObjDao($objDao) {
        $this->objDao = $objDao;
    }

    public function back_list() {

        $this->objDao->bank_list();
        $array = $this->objDao->getResult();

        if (sizeof($array) > 0) {

            $content = '';
            for ($i = 0; $i < sizeof($array); $i++) {
                $content .= '<option value="' . $array[$i]['ban_id'] . '">' . $array[$i]['ban_bank'] . '</option>';
            }

            $this->status = $this->objDao->getStatus();
            $this->message = $this->objDao->getMessage();
        } else {

            $client = new SoapClient(WSDL);

            $params = array(
                'auth' => array(
                    'login' => IDENTIFIER,
                    'tranKey' => $this->tran_key,
                    'seed' => $this->seed,
                    'additional' => ''
                )
            );
            $result = $client->__soapCall('getBankList', array($params));

            $array_bancos = $result->getBankListResult->item;
            for ($i = 0; $i < sizeof($array_bancos); $i++) {

                $exists = $this->objDao->validate_bank($array_bancos[$i]->bankCode);

                if ($exists) {
                    $this->objDao->update_bank($array_bancos[$i]->bankCode, $array_bancos[$i]->bankName);
                } else {
                    $this->objDao->insert_bank($array_bancos[$i]->bankCode, $array_bancos[$i]->bankName);
                }
            }

            $this->objDao->bank_list();
            $array = $this->objDao->getResult();

            $content = '';
            for ($i = 0; $i < sizeof($array); $i++) {
                $content .= '<option value="' . $array[$i]['ban_id'] . '">' . $array[$i]['ban_bank'] . '</option>';
            }

            $this->status = $this->objDao->getStatus();
            $this->message = $this->objDao->getMessage();
        }

        $this->result = $content;
    }

    public function province_list() {

        $this->objDao->province_list();
        $array = $this->objDao->getResult();

        $content = '';
        for ($i = 0; $i < sizeof($array); $i++) {
            $content .= '<option value="' . $array[$i]['pro_province'] . '">' . $array[$i]['pro_province'] . '</option>';
        }

        $this->status = $this->objDao->getStatus();
        $this->message = $this->objDao->getMessage();
        $this->result = $content;
    }

    public function city_list() {

        $content = '<option value="">Seleccione opción...</option>';

        if ($this->pay_province != '') {
            $this->objDao->city_list($this->pay_province);
            $array = $this->objDao->getResult();

            for ($i = 0; $i < sizeof($array); $i++) {
                $content .= '<option value="' . $array[$i]['cit_city'] . '">' . $array[$i]['cit_city'] . '</option>';
            }

            $this->status = $this->objDao->getStatus();
        } else {
            $this->status = TRUE;
        }

        $this->message = $this->objDao->getMessage();
        $this->result = $content;
    }

    public function make_payment() {

        $pay_reference = '1035420';
        $pay_description = 'Pago de pruebas';
        $pay_total_amount = '87000';
        $pay_tax_amount = '0';
        $pay_devolution_base = '0';
        $pay_tip_amount = '0';
        $pay_country = 'COP';

        $status = $this->objDao->insert_payment($pay_reference, $pay_description, $this->pay_bank, $this->pay_bank_type, $pay_total_amount, $pay_tax_amount, $pay_devolution_base, $pay_tip_amount, $this->pay_document, $this->pay_document_type, $this->pay_first_name, $this->pay_last_name, $this->pay_company, $this->pay_email_address, $this->pay_address, $this->pay_city, $this->pay_province, $pay_country, $this->pay_phone, $this->pay_mobile, $this->pay_ip_address, $this->pay_user_agent);

        if ($status) {

            $array = $this->objDao->getResult();
            $pay_id = $array[0]['pay_id'];

            $client = new SoapClient(WSDL);

            $params = array(
                'auth' => array(
                    'login' => IDENTIFIER,
                    'tranKey' => $this->tran_key,
                    'seed' => $this->seed,
                    'additional' => ''
                ),
                'transaction' => array(
                    'bankCode' => $this->pay_bank,
                    'bankInterface' => $this->pay_bank_type,
                    'returnURL' => 'http://localhost/placetopay/payment?page=result',
                    'reference' => $pay_reference,
                    'description' => $pay_description,
                    'language' => 'ES',
                    'currency' => 'COP',
                    'totalAmount' => (double) $pay_total_amount,
                    'taxAmount' => (double) $pay_tax_amount,
                    'devolutionBase' => (double) $pay_devolution_base,
                    'tipAmount' => (double) $pay_tip_amount,
                    'payer' => array(
                        'document' => $this->pay_document,
                        'documentType' => $this->pay_document_type,
                        'firstName' => $this->pay_first_name,
                        'lastName' => $this->pay_last_name,
                        'company' => $this->pay_company,
                        'emailAddress' => $this->pay_email_address,
                        'address' => $this->pay_address,
                        'city' => $this->pay_city,
                        'province' => $this->pay_province,
                        'country' => $pay_country,
                        'phone' => $this->pay_phone,
                        'mobile' => $this->pay_mobile
                    ),
                    'shipping' => array(
                        'document' => $this->pay_document,
                        'documentType' => $this->pay_document_type,
                        'firstName' => $this->pay_first_name,
                        'lastName' => $this->pay_last_name,
                        'company' => $this->pay_company,
                        'emailAddress' => $this->pay_email_address,
                        'address' => $this->pay_address,
                        'city' => $this->pay_city,
                        'province' => $this->pay_province,
                        'country' => $pay_country,
                        'phone' => $this->pay_phone,
                        'mobile' => $this->pay_mobile
                    ),
                    'ipAddress' => $this->pay_ip_address,
                    'userAgent' => $this->pay_user_agent,
                    'additionalData' => ''
                )
            );

            $result = $client->__soapCall('createTransaction', array($params));

            if ($result) {

                $status = $this->objDao->insert_payment_result($pay_id, $result->createTransactionResult->returnCode, $result->createTransactionResult->trazabilityCode, $result->createTransactionResult->transactionCycle, $result->createTransactionResult->transactionID, $result->createTransactionResult->sessionID, $result->createTransactionResult->bankCurrency, $result->createTransactionResult->bankFactor, $result->createTransactionResult->responseCode, $result->createTransactionResult->responseReasonCode, $result->createTransactionResult->responseReasonText);

                if ($result->createTransactionResult->returnCode == 'SUCCESS') {

                    $_SESSION['paymentID'] = $pay_id;
                    $_SESSION['transactionID'] = $result->createTransactionResult->transactionID;

                    $this->status = TRUE;
                    $this->result = $result->createTransactionResult->bankURL;
                    $this->message = $result->createTransactionResult->responseReasonText . '. En un segundo sera dirigido a PSE';
                } else {
                    $this->status = FALSE;
                    $this->message = $result->createTransactionResult->responseReasonText;
                }
            } else {
                $this->status = FALSE;
                $this->message = 'Se presente una falla en el llamado del WebService';
            }
        } else {
            $this->status = $status;
            $this->message = $this->objDao->getMessage();
        }
    }

    public function payment_result_list() {

        $this->objDao->payment_result_list();

        $this->status = $this->objDao->getStatus();
        if ($this->status) {

            $content = '';
            $array = $this->objDao->getResult();
            for ($i = 0; $i < sizeof($array); $i++) {

                $content .= '<tr>';
                $content .= '<td>' . ($i + 1) . '</td>';
                $content .= '<td>' . $array[$i]['pay_id'] . '</td>';
                $content .= '<td>' . $array[$i]['pay_reference'] . '</td>';
                $content .= '<td>' . $array[$i]['pay_description'] . '</td>';
                $content .= '<td>' . $array[$i]['pay_first_name'] . '</td>';
                $content .= '<td>' . $array[$i]['pay_last_name'] . '</td>';
                $content .= '<td>' . $array[$i]['pay_email_address'] . '</td>';
                $content .= '<td>' . $array[$i]['pay_status'] . '</td>';
                $content .= '<td>' . $array[$i]['pay_response_reason_text'] . '</td>';
                $content .= '</tr>';
            }
        } else {
            $content = '<tr>';
            $content .= '<td colspan="8">' . $this->objDao->getMessage() . '</td>';
            $content .= '</tr>';
        }
        $this->result = $content;
    }

    public function payment_result() {

        if (isset($_SESSION['transactionID']) && $_SESSION['paymentID'] != '' && $_SESSION['transactionID'] != '') {

            $client = new SoapClient(WSDL);

            $params = array(
                'auth' => array(
                    'login' => IDENTIFIER,
                    'tranKey' => $this->tran_key,
                    'seed' => $this->seed,
                    'additional' => ''
                ),
                'transactionID' => $_SESSION['transactionID']
            );
            $result = $client->__soapCall('getTransactionInformation', array($params));

            if ($result) {

                $status = $this->objDao->insert_payment_result($_SESSION['paymentID'], $result->getTransactionInformationResult->returnCode, $result->getTransactionInformationResult->trazabilityCode, $result->getTransactionInformationResult->transactionCycle, $result->getTransactionInformationResult->transactionID, $result->getTransactionInformationResult->sessionID, '?', '?', $result->getTransactionInformationResult->responseCode, $result->getTransactionInformationResult->responseReasonCode, $result->getTransactionInformationResult->responseReasonText);

                if ($result->getTransactionInformationResult->returnCode == 'SUCCESS') {

                    $_SESSION['paymentID'] = '';
                    $_SESSION['transactionID'] = '';

                    $this->status = TRUE;
                    $this->result = 'http://localhost/placetopay/payment?page=list';
                    $this->message = $result->getTransactionInformationResult->responseReasonText;
                } else {
                    $this->status = FALSE;
                    $this->message = $result->getTransactionInformationResult->responseReasonText;
                }
            } else {
                $this->status = FALSE;
                $this->message = 'Se presente una falla en el llamado del WebService';
            }
        } else {
            $this->status = FALSE;
            $this->result = 'http://localhost/placetopay/payment?page=add';
            $this->message = 'Faltan parametros';
        }
    }

}
