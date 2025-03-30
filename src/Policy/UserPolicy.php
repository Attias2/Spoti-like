<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\IdentityInterface;

/**
 * User policy
 */
class UserPolicy
{
    public function canAdd(IdentityInterface $user, User $userEntity)
    {
        return true;
    }

    
     /**
     * Check if $user can edit User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $User
     * @return bool
     */
    public function canEdit(IdentityInterface $user, User $User)
    {
        if ($user->get('hierarchy') === 'admin') {
            return true;
        }
    
        if ($User->isDirty('hierarchy')) {
            return false;
        }
    
        return $user->getIdentifier() === $User->id;
    }

    
    public function canDelete(IdentityInterface $user, User $userEntity)
    {
        if ($user->get('hierarchy') === 'admin') {
            return true;
        }

        return $user->getIdentifier() === $userEntity->id;
    }

    
    public function canView(IdentityInterface $user, User $userEntity)
    {
        if ($user->get('hierarchy') === 'admin') {
            return true;
        }

        return $user->getIdentifier() === $userEntity->id;
    }

   
    public function canIndex(IdentityInterface $user)
    {
        if ($user->get('hierarchy') === 'admin') {
            return true;
        }

        return $user->getIdentifier() === $userEntity->id;
    }
}
