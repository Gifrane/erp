<?php

namespace App\Mail;

use App\Models\Account\Account;
use App\Models\User\User;
use App\Services\TokenEncryption;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use function config;
use function json_encode;
use function str_replace;

class SendEmailResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    protected User $user;

    /**
     * @var Account
     */
    private Account $account;

    /**
     * Create a new message instance.
     *
     * @param User $user
     *
     * @return void
     */
    public function __construct(User $user, Account $account)
    {
        $this->account = $account;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $domain = config('app.enable_account_domain');
        $domain = str_replace('{{slug}}', $this->account->slug, $domain);
        
        $params_token = [];
        $params_token['account_id'] = $this->account->id;
        $params_token['user_id'] = $this->user->id;
        $params_token['user_email'] = $this->user->email;

        $token = TokenEncryption::encrypt(json_encode($params_token));

        return $this->subject('Activate your account on Gifrane')
            ->view('emails.enable_account', [
                'user' => $this->user, 'domain' => $domain, 'token' => $token
            ]);
    }
}
