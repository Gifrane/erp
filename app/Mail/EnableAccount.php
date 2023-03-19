<?php

namespace App\Mail;

use App\Models\User\User;
use App\Services\TokenEncryption;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use function config;
use function json_encode;

class EnableAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    protected User $user;

    /**
     * Create a new message instance.
     *
     * @param User $user
     *
     * @return void
     */
    public function __construct(User $user)
    {
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

        $params_token = [];
        $params_token['user_id'] = $this->user->id;
        $params_token['user_email'] = $this->user->email;

        $token = TokenEncryption::encrypt(json_encode($params_token));

        return $this->subject('Activate your account on Gifrane')
            ->view('emails.enable_account', [
                'user' => $this->user, 'domain' => $domain, 'token' => $token
            ]);
    }
}
