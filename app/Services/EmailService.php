<?php
/**
 * Created by PhpStorm.
 * User: ombharti
 * Date: 1/2/2018
 * Time: 5:03 PM
 */

namespace App\Services;

use App\Interfaces\EmailServiceInterface;
use App\Models\EmailTemplate;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailService implements EmailServiceInterface
{
    protected $mailer;

    protected $activationRepo;

    protected $resendAfter = 24;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail($data = [])
    {
        $to = $data['to'];
        $result = null;
        if (is_array($to)) {
            foreach ($data['to'] as $user_email) {
                $result = self::sendEmailToUser($user_email, $data['content_var_values'], $data['template']);
            }
        } else {
            $result = self::sendEmailToUser($to, $data['content_var_values'], $data['template']);
        }
        return $result;
    }

    public function sendEmailToUser($to, $dynamic_data, $template = null)
    {
        $from = env('MAIL_FROM_ADDRESS');
        $from_name = env('APP_NAME');

        $template_variables = Config::get('emailvariables.' . $template);
        $replace_array = $key_array = [];
        if (!empty($template_variables)) {
            foreach ($template_variables as $key => $template_variable) {
                $key_array[] = "#" . $key . "#";
                $replace_array[] = (isset($dynamic_data[trim($key, '#')])) ? $dynamic_data[trim($key, '#')] : '';
            }
        }
        // Email Template content get and replace variable with user value
        $email_data = EmailTemplate::where('identifier', $template)->first();
        if (isset($email_data)){
            $subject = $email_data->subject;
            $subject = str_replace($key_array, $replace_array, $subject);
            $content = str_replace($key_array, $replace_array, $email_data->content);
            $content_data = ['email_content' => $content];
            try {
                Mail::send('email_sample', $content_data, function ($message) use ($to, $from, $from_name, $subject) {
                    $message->from($from, $from_name)
                        ->to($to)
                        ->subject($subject);
                });
            } catch (\Exception $e) {
                Log::info("Email not sent from the Emails. Returned with error: " . $e->getMessage());
                return $e->getMessage();
            }
        }else{
            Log::info("Email not sent from the Emails. Don't get subject email");
        }
        return Mail::failures();
    }

}
