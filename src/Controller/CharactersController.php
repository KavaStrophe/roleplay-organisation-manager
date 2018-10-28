<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Characters Controller
 *
 * @property \App\Model\Table\CharactersTable $Characters
 *
 * @method \App\Model\Entity\Character[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CharactersController extends AppController
{
    public function isAuthorized($user) {
        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $characters = $this->paginate($this->Characters);

        $this->set(compact('characters'));
    }

    /**
     * View method
     *
     * @param string|null $id Character id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $character = $this->Characters->get($id, [
            'contain' => ['Users', 'Roles', 'CharactersOrganizationsRights']
        ]);

        $this->set('character', $character);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Auth->user();
        $character = $this->Characters->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $error = false;
            
            if($data['Old_Character'] < 1)
            {
                $error = true;
                $this->Flash->error(__('Le personnage ne peut pas avoir un âge négatif.'));
            }
            if($data['Height_Character'] < 1)
            {
                $error = true;
                $this->Flash->error(__('Le personnage ne peut pas avoir une taille négative.'));
            }
            if($data['Weight_Character'] < 1)
            {
                $error = true;
                $this->Flash->error(__('Le personnage ne peut pas avoir un poids négatif.'));
            }
            if($data['Gender_Character'] == 'other')
            {
                $data['Gender_Character'] = $data['Gender_Other_Character'];
            }
            unset($data['Gender_Other_Character']);
            $data['users_id'] = $user['id'];
            
            //Tests images
            $testImageType = exif_imagetype($data['Img_Character']['tmp_name']);
            if(!$testImageType)
            {
                $error = true;
                $this->Flash->error(__('Le format du fichier est incorrect.'));
            }
            
            if($data['Img_Character']['type'] > 1000000)
            {
                $error = true;
                $this->Flash->error(__('L\'image est trop lourde (max 1Mo)'));
            }
            
            if(!$error){
                $ext = (new \SplFileInfo($data['Img_Character']['name']))->getExtension();
                
                $char = 'abcdefghijklmnopqrstuvwxyz0123456789';
                $newNameLong = str_shuffle($char);
                $newName = substr($newNameLong, 0, 10) . '.' . $ext;
                $urlDest = WWW_ROOT . 'img/characters';
                $imageUrl = $data['Img_Character']['tmp_name'];
                move_uploaded_file($imageUrl, $urlDest . '/' . $newName );
                $data['Img_Character'] = $newName;
                
                $character = $this->Characters->patchEntity($character, $data);
                
                $result = $this->Characters->save($character);
                if ($result) {
                    $this->Flash->success(__('Le personnage a bien été sauvegardé'));
    
                    return $this->redirect(['controller' => 'Users', 'action' => 'viewChara']);
                }
                debug($character);
                $this->Flash->error(__('Le personnage n\'a pas pu être créé.'));
            }
        }
        
        $this->set(compact('character', 'users', 'roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Character id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $character = $this->Characters->get($id, [
            'contain' => ['Roles']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $character = $this->Characters->patchEntity($character, $this->request->getData());
            if ($this->Characters->save($character)) {
                $this->Flash->success(__('The character has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The character could not be saved. Please, try again.'));
        }
        $users = $this->Characters->Users->find('list', ['limit' => 200]);
        $roles = $this->Characters->Roles->find('list', ['limit' => 200]);
        $this->set(compact('character', 'users', 'roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Character id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $character = $this->Characters->get($id);
        if ($this->Characters->delete($character)) {
            $this->Flash->success(__('The character has been deleted.'));
        } else {
            $this->Flash->error(__('The character could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
