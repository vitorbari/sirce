<?php namespace Sirce\Services;

use Mailchimp;
use Sirce\Models\User;

class NewsletterManager
{
    protected $mailchimp;
    protected $listId = '64b5632011';        // Id of newsletter list

    /**
     * Pull the Mailchimp-instance (including API-key) from the IoC-container.
     */
    public function __construct(Mailchimp $mailchimp)
    {
        $this->mailchimp = $mailchimp;
    }

    /**
     * Subscribe user
     * @param User $user
     */
    public function subscribe(User $user)
    {
        try {
            $this->mailchimp
                ->lists
                ->subscribe(
                    $this->listId,
                    ['email' => $user->email]
                );
        } catch (\Mailchimp_List_AlreadySubscribed $e) {
            // do something
        } catch (\Mailchimp_Error $e) {
            // do something
        }
    }

    /**
     * Unsubscribe user
     * @param User $user
     */
    public function unsubscribe(User $user)
    {
        try {
            $this->mailchimp
                ->lists
                ->unsubscribe(
                    $this->listId,
                    ['email' => $user->email]
                );
        } catch (\Mailchimp_List_NotSubscribed $e) {
            // do something
        } catch (\Mailchimp_Error $e) {
            // do something
        }
    }
}