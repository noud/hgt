<?php

namespace HGT\Application\Content;

use DrewM\MailChimp\MailChimp;

class NewsletterService
{
    /**
     * NewsletterService constructor.
     * @param $mailchimp_api_key
     * @throws \Exception
     */
    public function __construct($mailchimp_api_key)
    {
        $this->mailChimp = new MailChimp($mailchimp_api_key);
    }

    /**
     * @param string $listId
     * @param string $emailAddress
     * @return array|false
     */
    public function listSubscribe($listId, $emailAddress)
    {
        $result = $this->mailChimp->post("lists/$listId/members", [
            'email_address' => $emailAddress,
            'status' => 'subscribed',
        ]);

        return $result;
    }
}
