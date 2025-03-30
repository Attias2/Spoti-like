<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users form">
    <?= $this->Flash->render() ?>
    <h3>Login</h3>
    <?= $this->Form->create() ?>
        <?= $this->Form->control('name') ?>
        <?= $this->Form->control('password') ?>
    <?= $this->Form->button(__('Login')); ?>
    <?= $this->Form->end() ?>

</div>