<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>"><span>Cake</span>PHP</a>
        </div>
        <div class="top-nav-links">
        <?php 
            if(empty($this-> request -> getAttribute('identity'))) {
                echo $this->Html ->link('Register', ['controller' => 'Users', 'action'=>'add']);
                echo $this->Html ->link('Login', ['controller' => 'Users', 'action'=>'login']);
            }
           // echo $this->request->getAttribute('identity')->hierarchy;
            if(!empty($this-> request -> getAttribute('identity')) ) {

                echo $this->Html->link('Se déconnecter', ['controller' => 'Users', 'action'=>'logout']);
                echo $this->Html->link('User',['controller' => 'Users', 'action'=> 'index']);
                echo $this->Html->link('Artists',['controller' => 'Artists', 'action'=> 'index']);
                
                echo $this->Html->link('Albums',['controller'  => 'Albums', 'action'=> 'index']);
                echo $this->Html->link('Requests',['controller'  => 'Requests', 'action'=> 'index']);

                if($this->request->getAttribute('identity')->hierarchy === 'admin'){
                    
                }
                else{
                    echo $this->Html->link('Ask an add',['controller' => 'Requests', 'action'=> 'add']);
                }
                
            }

            

            
            ?>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>
