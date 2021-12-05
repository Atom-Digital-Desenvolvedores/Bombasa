<?php

    include('../../../wp-load.php');

    $slugContatoEmailId = get_page_by_path( 'configuracoes-de-e-mail', OBJECT, 'gerais' )->ID;

    $idContato = get_page_by_path( 'contato', OBJECT, 'page' )->ID;
    $wq_contato_secret_key = get_post_meta($idContato, 'wq_contato_secret_key', true);

    if ($wq_contato_secret_key !== NULL && strlen($wq_contato_secret_key) > 0) {
        $captcha_data = NULL;
        if (isset($_POST['g-recaptcha-response'])) {
            $captcha_data = $_POST['g-recaptcha-response'];
        }
        if ($captcha_data !== NULL) {
            // Se nenhum valor foi recebido, o usuário não realizou o captcha
            if (!$captcha_data) {
                echo    '{
                            "success": false,
                            "title": "Falha no envio",
                            "message": "Captcha inválido"
                        }';
                exit;
            }
            $resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$wq_contato_secret_key."&response=".$captcha_data."&remoteip=".$_SERVER['REMOTE_ADDR']);
            $resposta = json_decode($resposta);
            if (!$resposta->success) {
                echo    '{
                            "success": false,
                            "title": "Falha no envio",
                            "message": "Captcha inválido"
                        }';
                exit;
            }
        }
    }
    if (!swpsmtp_credentials_configured()) {
        echo    '{
                    "success": false,
                    "title": "Falha no envio",
                    "message": "Erro ao enviar sua mensagem, credenciais de envio não foram configuradas."
                }';
        exit;
    }
    $url_redirect   = (isset($_REQUEST['url_redirect'])) ? $_REQUEST['url_redirect'] : NULL;
    $assunto        = $_REQUEST['subject_email'];
    $mensagem       = "<html><body>\n\r";
    $mensagem      .= "<font face=\"Verdana, Geneva, sans-serif\"><h1>".$_REQUEST['title_email']."</h1>";

    $parans = array();
    foreach ($_REQUEST as $key => $value) {
        $mensagem .= "\n\r";
        if (strpos($key, 'send-data-') === 0) {
            $label = $_REQUEST['label-'.$key];
            $mensagem .= "<p><b>".$label.": </b>" . $value . "</p>";
        }
    }

    $mensagem      .= "</font></body></html>";

    $swpsmtp_options = get_option('swpsmtp_options');

    require_once( ABSPATH . WPINC . '/class-phpmailer.php' );
    $mail = new PHPMailer();

    $charset = get_bloginfo('charset');
    $mail->CharSet = $charset;

    $from_name = $swpsmtp_options['from_name_field'];
    $from_email = $swpsmtp_options['from_email_field'];

    $mail->IsSMTP();

    /* If using smtp auth, set the username & password */
    if ('yes' == $swpsmtp_options['smtp_settings']['autentication']) {
        $mail->SMTPAuth = true;
        $mail->Username = $swpsmtp_options['smtp_settings']['username'];
        $mail->Password = swpsmtp_get_password();
    }

    /* Set the SMTPSecure value, if set to none, leave this blank */
    if ($swpsmtp_options['smtp_settings']['type_encryption'] !== 'none') {
        $mail->SMTPSecure = $swpsmtp_options['smtp_settings']['type_encryption'];
    }

    /* PHPMailer 5.2.10 introduced this option. However, this might cause issues if the server is advertising TLS with an invalid certificate. */
    $mail->SMTPAutoTLS = false;

    /* Set the other options */
    $mail->Host = $swpsmtp_options['smtp_settings']['host'];
    $mail->Port = $swpsmtp_options['smtp_settings']['port'];
    $mail->SetFrom($from_email, $from_name);
    $mail->isHTML(true);
    $mail->Subject = $assunto;

    $mail->MsgHTML($mensagem);

    $addaddress_smtprecipients_send_mail = get_post_meta($slugContatoEmailId, 'addaddress_smtprecipients_send_mail', true);
    foreach ($addaddress_smtprecipients_send_mail as $key => $email) {
        $mail->AddAddress($email);
    }

    $addcc_smtprecipients_send_mail = get_post_meta($slugContatoEmailId, 'addcc_smtprecipients_send_mail', true);
    if ($addcc_smtprecipients_send_mail !== NULL && is_array($addcc_smtprecipients_send_mail) && count($addcc_smtprecipients_send_mail) > 0) {
        foreach ($addcc_smtprecipients_send_mail as $key => $email) {
            $mail->addCC($email);
        }
    }

    $addbcc_smtprecipients_send_mail = get_post_meta($slugContatoEmailId, 'addbcc_smtprecipients_send_mail', true);
    if ($addbcc_smtprecipients_send_mail !== NULL && is_array($addbcc_smtprecipients_send_mail) && count($addbcc_smtprecipients_send_mail) > 0) {
        foreach ($addbcc_smtprecipients_send_mail as $key => $email) {
            $mail->addBCC($email);
        }
    }

    // $mail->AddAddress(get_post_meta( $idContatoPage, 'mail_contato', true ));
    $mail->SMTPDebug = 0;

    if (
            isset($_FILES['send-data-file'])
                &&
            $_FILES['send-data-file']['error'] == UPLOAD_ERR_OK
        ) {
        $mail->addAttachment($_FILES['send-data-file']['tmp_name'], $_FILES['send-data-file']['name']);
    }

    /* Send mail and return result */
    if (!$mail->Send())
        $errors = $mail->ErrorInfo;

    $mail->ClearAddresses();
    $mail->ClearAllRecipients();

    if (!empty($errors)) {
        echo    '{
                    "success": false,
                    "title": "Falha no envio",
                    "message": "Erro ao enviar sua mensagem, tente novamente mais tarde."
                }';
    } else {
        if ($url_redirect !== NULL) {
            echo    '{
                        "success": true,
                        "title": "Enviado com sucesso",
                        "message": "Mensagem enviada com sucesso."
                    }';
        }else{
            echo    '{
                        "success": true,
                        "title": "Enviado com sucesso",
                        "url_redirect": "'.$url_redirect.'",
                        "message": "Mensagem enviada com sucesso."
                    }';
        }
    }
?>