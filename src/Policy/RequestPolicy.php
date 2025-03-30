<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Request;
use Authorization\IdentityInterface;

/**
 * Request policy
 */
class RequestPolicy
{

    public function canIndex(IdentityInterface $user, Request $request)
    {

        return $user->get('hierarchy') === 'admin' || $user->getIdentifier() === $request->user_id;
    }
    /**
     * Check if $user can add Request
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Request $request
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Request $request)
    {
        return true;
    }

    /**
     * Check if $user can edit Request
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Request $request
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Request $request)
    {

        if ($user->get('hierarchy') === 'admin') {
            return true;
        }

        if ($user->getIdentifier() === $request->user_id) {
            return !$request->isDirty('status');
        }

        return false;
    }

    /**
     * Check if $user can delete Request
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Request $request
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Request $request)
    {
        return $user->get('hierarchy') === 'admin' || $user->getIdentifier() === $request->user_id;
    }

    /**
     * Check if $user can view Request
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Request $request
     * @return bool
     */
    public function canView(IdentityInterface $user, Request $request)
    {
        return $user->get('hierarchy') === 'admin' || $user->getIdentifier() === $request->user_id;
    }
}
