<?php
session_start();

//Esta variable recibe el valor enviado por la url, en el que se indica el caso del controlador que se va ejecutar.
$option = isset($_GET['option']) ? htmlspecialchars(stripcslashes($_GET['option'])) : '0';

include_once '../model/paymentMod.php';
$objMod = new paymentMod();

switch ($option) {

    case '1': {

            $objMod->back_list();
            echo json_encode(array('status' => $objMod->getStatus(), 'res' => $objMod->getResult(), 'msg' => $objMod->getMessage()));
            break;
        }

    case '2': {

            $objMod->province_list();
            echo json_encode(array('status' => $objMod->getStatus(), 'res' => $objMod->getResult(), 'msg' => $objMod->getMessage()));
            break;
        }

    case '3': {

            $pay_province = isset($_POST['province']) ? $_POST['province'] : '';

            $objMod->setPay_province($pay_province);

            $objMod->city_list();
            echo json_encode(array('status' => $objMod->getStatus(), 'res' => $objMod->getResult(), 'msg' => $objMod->getMessage()));
            break;
        }

    case '4': {

            $pay_bank_type = isset($_POST['x_type_payment']) ? $_POST['x_type_payment'] : '';
            $pay_bank = isset($_POST['x_bank_id']) ? $_POST['x_bank_id'] : '';
            $pay_document_type = isset($_POST['x_type_document']) ? $_POST['x_type_document'] : '';
            $pay_document = isset($_POST['x_document']) ? $_POST['x_document'] : '';
            $pay_first_name = isset($_POST['x_name']) ? $_POST['x_name'] : '';
            $pay_last_name = isset($_POST['x_last_name']) ? $_POST['x_last_name'] : '';
            $pay_company = isset($_POST['x_company']) ? $_POST['x_company'] : '';
            $pay_email_address = isset($_POST['x_email_address']) ? $_POST['x_email_address'] : '';
            $pay_address = isset($_POST['x_address']) ? $_POST['x_address'] : '';
            $pay_province = isset($_POST['x_province']) ? $_POST['x_province'] : '';
            $pay_city = isset($_POST['x_city']) ? $_POST['x_city'] : '';
            $pay_phone = isset($_POST['x_phone']) ? $_POST['x_phone'] : '';
            $pay_mobile = isset($_POST['x_mobile']) ? $_POST['x_mobile'] : '';

            $objMod->setPay_bank_type($pay_bank_type);
            $objMod->setPay_bank($pay_bank);
            $objMod->setPay_document_type($pay_document_type);
            $objMod->setPay_document($pay_document);
            $objMod->setPay_first_name($pay_first_name);
            $objMod->setPay_last_name($pay_last_name);
            $objMod->setPay_company($pay_company);
            $objMod->setPay_email_address($pay_email_address);
            $objMod->setPay_address($pay_address);
            $objMod->setPay_province($pay_province);
            $objMod->setPay_city($pay_city);
            $objMod->setPay_phone($pay_phone);
            $objMod->setPay_mobile($pay_mobile);

            $objMod->make_payment();
            echo json_encode(array('status' => $objMod->getStatus(), 'res' => $objMod->getResult(), 'msg' => $objMod->getMessage()));
            break;
        }

    case '5': {

            $objMod->payment_result_list();
            echo json_encode(array('status' => $objMod->getStatus(), 'res' => $objMod->getResult(), 'msg' => $objMod->getMessage()));
            break;
        }

    case '6': {

            $objMod->payment_result();
            echo json_encode(array('status' => $objMod->getStatus(), 'res' => $objMod->getResult(), 'msg' => $objMod->getMessage()));
            break;
        }
}