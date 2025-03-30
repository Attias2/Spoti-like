<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Artist> $artists
  * @var \Authorization\IdentityInterface $currentUser
 */

 $currentUser = $this->getRequest()->getAttribute('identity');
?>
<div class="artists index content">

    <?php
        if($currentUser->get('hierarchy') === 'admin'){
            echo $this->Html->link(__('New Artist'), ['action' => 'add'], ['class' => 'button float-right']);
        }
    ?>
    <h3><?= __('Artists') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('first_name') ?></th>
                    <th><?= $this->Paginator->sort('last_name') ?></th>
                    <th><?= $this->Paginator->sort('image_profile') ?></th>
                    <th><?= $this->Paginator->sort('fb') ?></th>
                    <th><?= $this->Paginator->sort('player_spotify') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($artists as $artist): ?>
                <tr>
                    <td><?= $this->Number->format($artist->id) ?></td>
                    <td><?= h($artist->first_name) ?></td>
                    <td><?= h($artist->last_name) ?></td>
                    <td><?= h($artist->image_profile) ?></td>
                    <td><?= h($artist->fb) ?></td>
                    <td><?= h($artist->player_spotify) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $artist->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $artist->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $artist->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $artist->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>