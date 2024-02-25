<?php
function email_model($title, $message) {

    ob_start();
    $escaped_description = stripslashes(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
    $escaped_description_with_line_breaks = nl2br($message);
    $code = "

    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>$title</title>
    </head>
    <body style='font-family: Arial, sans-serif;'>
    <table width='100%' cellspacing='0' cellpadding='0' style='border-collapse: collapse;'>
            <tr>
                <td align='center' style='padding: 20px 0;'>
                    <img src='https://new.thenetworkers.co.nz/wp-content/uploads/2023/07/The-Networkers-Logo-665x230-1.png' alt='The Networkers Logo' width='250'>
                </td>
            </tr>
            <tr>
                <td align='center' style='padding: 0 20px;'>
                    <table width='500px' cellspacing='0' cellpadding='0' style='border-collapse: collapse;'>
                        <tr>
                            <td align='left' style='padding: 20px 0;'>
                                <h2>$title</h2>
                            </td>
                        </tr>
                        <tr>
                            <td align='left'>
                                <p>$escaped_description_with_line_breaks</p>
                            </td>
                        </tr>
                    </table>   
                    
                </td>
            </tr>
            <tr>
                <td align='center' style='padding: 20px 0;'>
                    <p style='color: #888;'>Sent via The Networkers</p>
                </td>
            </tr>
        </table>
    </body>
    </html>
    ";

    return $code;
}
?>