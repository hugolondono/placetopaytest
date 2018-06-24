<?php

class paymentDao {

    private $status;
    private $message;
    private $result;
    private $link;

    function __construct() {

        $this->message = '';
        $this->result = array();

        include_once 'conexion.php';
        $this->link = new conexion();
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

    function setStatus($status) {
        $this->status = $status;
    }

    function setMessage($message) {
        $this->message = $message;
    }

    function setResult($result) {
        $this->result = $result;
    }

    public function validate_bank($ban_id) {

        $row = array();
        $status = TRUE;
        $conn = $this->link->connect();

        if (!$conn) {
            $this->message = $this->link->getError();
            $status = FALSE;
        } else {

            $sql = 'SELECT * FROM `ptp_bank_ban` WHERE `ban_id` = ' . $ban_id . ';';
            $rs = $conn->query($sql);

            if ($rs->num_rows > 0) {
                $status = TRUE;
            } else {
                $status = FALSE;
            }

            $this->link->disconnect();
        }

        return $status;
    }

    public function update_bank($ban_id, $ban_bank) {

        $status = TRUE;
        $conn = $this->link->connect();

        if (!$conn) {
            $this->message = $this->link->getError();
            $status = FALSE;
        } else {

            $sql = 'UPDATE `ptp_bank_ban` SET `ban_bank` = \'' . $ban_bank . '\', `ban_date` = CURDATE() WHERE `ban_id` = ' . $ban_id . ';';
            $rs = $conn->query($sql);

            if ($rs > 0) {
                $status = TRUE;
            } else {
                $this->message = 'Error al ejecutar la consulta';
                $status = FALSE;
            }
        }

        return $status;
    }

    public function insert_bank($ban_id, $ban_bank) {

        $status = TRUE;
        $conn = $this->link->connect();

        if (!$conn) {
            $this->message = $this->link->getError();
            $status = FALSE;
        } else {

            $sql = 'INSERT INTO `ptp_bank_ban`(`ban_id`, `ban_bank`, `ban_date`) VALUES (' . $ban_id . ', \'' . $ban_bank . '\', CURDATE());';
            $rs = $conn->query($sql);

            if ($rs > 0) {
                $status = TRUE;
            } else {
                $this->message = 'Error al ejecutar la consulta';
                $status = FALSE;
            }
        }

        return $status;
    }

    public function bank_list() {

        $row = array();
        $status = TRUE;
        $conn = $this->link->connect();

        if (!$conn) {
            $this->message = $this->link->getError();
            $status = FALSE;
        } else {

            $sql = 'SELECT `ban_id`, `ban_bank` FROM `ptp_bank_ban` WHERE `ban_date` = CURDATE() ORDER BY `ban_bank`;';
            $rs = $conn->query($sql);

            if ($rs->num_rows > 0) {
                $i = 0;
                while ($data = $rs->fetch_assoc()) {

                    $row[$i]['ban_id'] = $data['ban_id'];
                    $row[$i]['ban_bank'] = $data['ban_bank'];

                    $i++;
                }
                $status = TRUE;
            } else {
                $this->message = 'Error al ejecutar la consulta';
                $status = FALSE;
            }

            $this->link->disconnect();
        }

        $this->status = $status;
        $this->result = $row;
    }

    public function province_list() {

        $row = array();
        $status = TRUE;
        $conn = $this->link->connect();

        if (!$conn) {
            $this->message = $this->link->getError();
            $status = FALSE;
        } else {

            $sql = 'SELECT `pro_id`, `pro_province` FROM `ptp_province_pro` WHERE `ptp_country_cou_cou_id` = 170;';
            $rs = $conn->query($sql);

            if ($rs->num_rows > 0) {
                $i = 0;
                while ($data = $rs->fetch_assoc()) {

                    $row[$i]['pro_id'] = $data['pro_id'];
                    $row[$i]['pro_province'] = $data['pro_province'];

                    $i++;
                }
                $status = TRUE;
            } else {
                $this->message = 'Error al ejecutar la consulta';
                $status = FALSE;
            }

            $this->link->disconnect();
        }

        $this->status = $status;
        $this->result = $row;
    }

    public function city_list($pay_province) {

        $row = array();
        $status = TRUE;
        $conn = $this->link->connect();

        if (!$conn) {
            $this->message = $this->link->getError();
            $status = FALSE;
        } else {

            $sql = 'SELECT `cit_id`, `cit_city` FROM `ptp_city_cit` WHERE `ptp_province_pro_pro_id` = (SELECT `pro_id` FROM `ptp_province_pro` WHERE `pro_province` = \'' . $pay_province . '\');';
            $rs = $conn->query($sql);

            if ($rs->num_rows > 0) {
                $i = 0;
                while ($data = $rs->fetch_assoc()) {

                    $row[$i]['cit_id'] = $data['cit_id'];
                    $row[$i]['cit_city'] = $data['cit_city'];

                    $i++;
                }
                $status = TRUE;
            } else {
                $this->message = 'Error al ejecutar la consulta';
                $status = FALSE;
            }

            $this->link->disconnect();
        }

        $this->status = $status;
        $this->result = $row;
    }

    public function insert_payment($pay_reference, $pay_description, $pay_bank, $pay_bank_type, $pay_total_amount, $pay_tax_amount, $pay_devolution_base, $pay_tip_amount, $pay_document, $pay_document_type, $pay_first_name, $pay_last_name, $pay_company, $pay_email_address, $pay_address, $pay_city, $pay_province, $pay_country, $pay_phone, $pay_mobile, $pay_ip_address, $pay_user_agent) {

        $row = array();
        $status = TRUE;
        $conn = $this->link->connect();

        if (!$conn) {
            $this->message = $this->link->getError();
            $status = FALSE;
        } else {

            $sql = 'INSERT INTO `ptp_payment_pay`(`pay_reference`, `pay_description`, `pay_bank`, `pay_bank_type`, `pay_total_amount`, `pay_tax_amount`, `pay_devolution_base`, `pay_tip_amount`, `pay_document`, `pay_document_type`, `pay_first_name`, `pay_last_name`, `pay_company`, `pay_email_address`, `pay_address`, `pay_city`, `pay_province`, `pay_country`, `pay_phone`, `pay_mobile`, `pay_ip_address`, `pay_user_agent`) VALUES (\'' . $pay_reference . '\', \'' . $pay_description . '\', \'' . $pay_bank . '\', \'' . $pay_bank_type . '\', \'' . $pay_total_amount . '\', \'' . $pay_tax_amount . '\', \'' . $pay_devolution_base . '\', \'' . $pay_tip_amount . '\', \'' . $pay_document . '\', \'' . $pay_document_type . '\', \'' . $pay_first_name . '\', \'' . $pay_last_name . '\', \'' . $pay_company . '\', \'' . $pay_email_address . '\', \'' . $pay_address . '\', \'' . $pay_city . '\', \'' . $pay_province . '\', \'' . $pay_country . '\', \'' . $pay_phone . '\', \'' . $pay_mobile . '\', \'' . $pay_ip_address . '\', \'' . $pay_user_agent . '\');';
            $rs = $conn->query($sql);

            if ($rs > 0) {

                $sql_2 = 'SELECT `pay_id` FROM `ptp_payment_pay` WHERE `pay_reference` = \'' . $pay_reference . '\' AND `pay_document`= \'' . $pay_document . '\' ORDER BY `pay_date_register` DESC LIMIT 1;';
                $rs_2 = $conn->query($sql_2);
                if ($rs_2->num_rows > 0) {
                    $i = 0;
                    while ($data = $rs_2->fetch_assoc()) {

                        $row[$i]['pay_id'] = $data['pay_id'];
                        $i++;
                    }
                    $this->result = $row;
                    $status = TRUE;
                } else {
                    $this->message = 'Se realizó el registro pero no se pudo consultar el último ID';
                    $status = FALSE;
                }
            } else {
                $this->message = 'Error al ejecutar la sentencia';
                $status = FALSE;
            }
        }

        return $status;
    }

    public function insert_payment_result($rpa_pay_id, $rpa_status, $rpa_trazability_code, $rpa_transaction_cycle, $rpa_transaction_id, $rpa_session_id, $rpa_bank_currency, $rpa_bank_factor, $rpa_response_code, $rpa_response_reason_code, $rpa_response_reason_text) {

        $row = array();
        $status = TRUE;
        $conn = $this->link->connect();

        if (!$conn) {
            $this->message = $this->link->getError();
            $status = FALSE;
        } else {

            $sql = 'INSERT INTO `ptp_result_payment_rpa`(`rpa_pay_id`, `rpa_status`, `rpa_trazability_code`, `rpa_transaction_cycle`, `rpa_transaction_id`, `rpa_session_id`, `rpa_bank_currency`, `rpa_bank_factor`, `rpa_response_code`, `rpa_response_reason_code`, `rpa_response_reason_text`) VALUES (\'' . $rpa_pay_id . '\', \'' . $rpa_status . '\', \'' . $rpa_trazability_code . '\', \'' . $rpa_transaction_cycle . '\', \'' . $rpa_transaction_id . '\', \'' . $rpa_session_id . '\', \'' . $rpa_bank_currency . '\', \'' . $rpa_bank_factor . '\', \'' . $rpa_response_code . '\', \'' . $rpa_response_reason_code . '\', \'' . $rpa_response_reason_text . '\');';
            $rs = $conn->query($sql);

            if ($rs > 0) {

                $this->message = 'Se registro la respuesta con exito';
                $status = TRUE;
            } else {
                $this->message = 'Error al ejecutar la sentencia';
                $status = FALSE;
            }
        }

        return $status;
    }

    public function payment_result_list() {

        $row = array();
        $status = TRUE;
        $conn = $this->link->connect();

        if (!$conn) {
            $this->message = $this->link->getError();
            $status = FALSE;
        } else {

            $sql = 'SELECT `pay_id`, `pay_reference`, `pay_description`, `pay_first_name`, `pay_last_name`, `pay_email_address`, `rpa_status`, `rpa_response_reason_text` FROM `ptp_payment_pay` INNER JOIN `ptp_result_payment_rpa` ON `rpa_pay_id` = `pay_id`;';
            $rs = $conn->query($sql);

            if ($rs->num_rows > 0) {
                $i = 0;
                while ($data = $rs->fetch_assoc()) {

                    $row[$i]['pay_id'] = $data['pay_id'];
                    $row[$i]['pay_reference'] = $data['pay_reference'];
                    $row[$i]['pay_description'] = $data['pay_description'];
                    $row[$i]['pay_first_name'] = $data['pay_first_name'];
                    $row[$i]['pay_last_name'] = $data['pay_last_name'];
                    $row[$i]['pay_email_address'] = $data['pay_email_address'];
                    $row[$i]['pay_status'] = $data['rpa_status'];
                    $row[$i]['pay_response_reason_text'] = $data['rpa_response_reason_text'];

                    $i++;
                }
                $status = TRUE;
            } else {
                $this->message = 'Error al ejecutar la consulta';
                $status = FALSE;
            }

            $this->link->disconnect();
        }
        
        $this->status = $status;
        $this->result = $row;
    }

}
