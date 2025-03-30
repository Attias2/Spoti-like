<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Requests Controller
 *
 * @property \App\Model\Table\RequestsTable $Requests
 */
class RequestsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization(); 
        $user = $this->Authentication->getIdentity();

        if ($user->get('hierarchy') === 'admin') {
            $query = $this->Requests->find()->contain(['Users']);
        } else {
            $query = $this->Requests->find()
                ->where(['user_id' => $user->getIdentifier()])
                ->contain(['Users']);
        }

        $requests = $this->paginate($query);
        $this->set(compact('requests'));
    }


    /**
     * View method
     *
     * @param string|null $id Request id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $request = $this->Requests->get($id, contain: ['Users']);
        $this->Authorization->authorize($request, 'view');

        $this->set(compact('request'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        
        $request = $this->Requests->newEmptyEntity();
        $currentUser = $this->Authentication->getIdentity();

        if ($this->request->is('post')) {
            $request = $this->Requests->patchEntity($request, $this->request->getData());
            
            // Assigne automatiquement le user_id au user connecté
            $request->user_id = $currentUser->getIdentifier();

            if ($this->Requests->save($request)) {
                $this->Flash->success(__('The request has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The request could not be saved. Please, try again.'));
        }

        $this->set(compact('request'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Request id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        
        $request = $this->Requests->get($id, contain: []);
        $this->Authorization->authorize($request, 'edit');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $request = $this->Requests->patchEntity($request, $this->request->getData());
            if ($this->Requests->save($request)) {
                $this->Flash->success(__('The request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The request could not be saved. Please, try again.'));
        }
        $users = $this->Requests->Users->find('list', limit: 200)->all();
        $this->set(compact('request', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Request id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $request = $this->Requests->newEmptyEntity();
        $this->Authorization->authorize($request, 'delete');

        $this->request->allowMethod(['post', 'delete']);
        $request = $this->Requests->get($id);
        if ($this->Requests->delete($request)) {
            $this->Flash->success(__('The request has been deleted.'));
        } else {
            $this->Flash->error(__('The request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
