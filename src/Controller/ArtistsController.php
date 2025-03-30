<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Artists Controller
 *
 * @property \App\Model\Table\ArtistsTable $Artists
 */
class ArtistsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $query = $this->Artists->find();
        $artists = $this->paginate($query);

        $this->set(compact('artists'));
    }

    /**
     * View method
     *
     * @param string|null $id Artist id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $artist = $this->Artists->get($id, contain: ['Albums']);
        $this->set(compact('artist'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $artist = $this->Artists->newEmptyEntity();
        $this->Authorization->authorize($artist, 'add');
        
        if ($this->request->is('post')) {
            // Gérer le fichier image
            if (!empty($this->request->getData('image_profile')['tmp_name'])) {
                // Récupérer l'image téléchargée
                $image = $this->request->getData('image_profile');
                
                // Définir le nom du fichier
                $imageName = uniqid() . '_' . $image['name'];
                
                // Définir le chemin de sauvegarde de l'image
                $uploadPath = WWW_ROOT . 'img' . DS . 'artists' . DS;
                $uploadFile = $uploadPath . $imageName;
                
                // Déplacer l'image vers le dossier 'artists'
                if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
                    // Si l'image est téléchargée avec succès, on peut l'enregistrer dans l'entité
                    $artist->image_profile = $imageName;
                } else {
                    $this->Flash->error(__('Failed to upload image.'));
                    return $this->redirect(['action' => 'index']);
                }
            }
            
            // Patch des données et sauvegarde de l'artiste
            $artist = $this->Artists->patchEntity($artist, $this->request->getData());
            
            if ($this->Artists->save($artist)) {
                $this->Flash->success(__('The artist has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            
            $this->Flash->error(__('The artist could not be saved. Please, try again.'));
        }
        
        $this->set(compact('artist'));
    }
    

    /**
     * Edit method
     *
     * @param string|null $id Artist id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        
        $artist = $this->Artists->get($id, contain: []);
        $this->Authorization->authorize($artist, 'edit');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $artist = $this->Artists->patchEntity($artist, $this->request->getData());
            if ($this->Artists->save($artist)) {
                $this->Flash->success(__('The artist has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The artist could not be saved. Please, try again.'));
        }
        $this->set(compact('artist'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Artist id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $artist = $this->Artists->get($id);
        $this->Authorization->authorize($artist, 'delete');
        if ($this->Artists->delete($artist)) {
            $this->Flash->success(__('The artist has been deleted.'));
        } else {
            $this->Flash->error(__('The artist could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
