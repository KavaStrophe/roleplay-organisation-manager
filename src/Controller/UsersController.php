<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Http\Middleware\EncryptedCookieMiddleware;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['add', 'login', 'logout']);
    }
    public function isAuthorized($user) {
        return parent::isAuthorized($user);
    }
    
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $user = $this->Auth->user();
        if($user['Role_User'] != 'admin')
            return $this->redirect(['action' => 'view', $user['id']]);
        
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Auth->user();
        if($id == null)
            $id = $user['id'];
        if($user['Role_User'] == 'admin' || $user['id'] == $id)
        {
            $userCharac = $this->Users->get($id, [
                'contain' => ['Characters']
            ]);
    
            $this->set('userCharac', $userCharac);
        }
        else
            return $this->redirect(['action' => 'view', $user['id']]);
            
    }
    
    public function viewChara($id = null)
    {
        $user = $this->Auth->user();
        if($id == null)
            $id = $user['id'];
            if($user['Role_User'] == 'admin' || $user['id'] == $id)
            {
                $userCharac = $this->Users->get($id, [
                    'contain' => ['Characters']
                ]);
                
                $this->set('userCharac', $userCharac);
            }
            else
                return $this->redirect(['action' => 'view', $user['id']]);
                
    }
    
    public function viewOrga($id)
    {
        $user = $this->Auth->user();
        if($id == null)
            $id = $user['id'];
        if($user['Role_User'] == 'admin' || $user['id'] == $id)
        {
            $this->loadModel('Organizations');
            $this->loadModel('Characters');
            
            $myOrga = $this->Organizations->find()
                ->where(['users_id' => $id])
                ->toArray();
                
            $otherOrga  = $this->Characters->find()
                ->where(['users_id' => $id])
                ->matching('Roles')
                ->contain('Roles', function($q){
                    return $q->contain('Organizations');
                })
                ->toArray();
            
                $this->set('otherOrga', $otherOrga);
                $this->set('myOrga', $myOrga);
        }
        else
            return $this->redirect(['action' => 'viewOrga', $user['id']]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $newUser = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $users = $this->Users->find()
                ->where(['Login_User' => $data['Login_User']])
                ->toArray();
            
            if(count($users) > 0)
            {
                $this->Flash->error(__("Ce nom d'utilisateur existe déjà !"));
            }
            else
            {
                $newUser->Login_User = $data['Login_User'];
                $newUser->Password_User = $data['Password_User'];
                if(isset($user) && $user['role'] == 'admin')
                    $newUser->Role_User = $data['Role_User'];
                else
                    $newUser->Role_User = 'user';
                $newUser->Registred_User = date("d-m-Y");
                    
                if ($this->Users->save($newUser)) {
                    $this->Flash->success(__('Le compte a bien été enregistré.'));
                    return $this->redirect(['action' => 'login']);
                }
                $this->Flash->error(__("Erreur lors de l'enregistrement."));
            }
        }
        $this->set(compact('newUser'));
    }
    
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $data = $this->request->getData();
                
                $this->Auth->setUser($user);
                $this->Flash->success(__('Vous êtes bien connecté.'));
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Nom de compte ou mot de passe incorrect.'));
        }
    }
    
    public function logout()
    {
        $this->Flash->success(__('Déconnexion réussie.'));
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Auth->user();
        
        if($user['Role_User'] == 'admin' || $user['id'] == $id)
        {
            $userCurrent = $this->Users->get($id);
            
            if ($this->request->is(['patch', 'post', 'put'])) {
                $data = $this->request->getData();
                
                $userCurrent->Password_User = $data['New_Password_User_Pass'];
                if($user['Role_User'] == 'admin')
                    $userCurrent->Role_User = $data['Role_User'];
                
                 if ($this->Users->save($userCurrent)) {
                    $this->Flash->success(__('Les modifications ont bien été enregistrées.'));
                    return $this->redirect(['action' => 'edit', $user['id']]);
                 }
                 $this->Flash->error(__('Erreur lors de la sauvegarde de l\'utilisatuer, veuillez réessayer'));
            }
            $this->set(compact('userCurrent'));
        }
        else
            return $this->redirect(['action' => 'edit', $user['id']]);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if($user['role'] == 'admin'){
            $this->request->allowMethod(['post', 'delete']);
            $user = $this->Users->get($id);
            if ($this->Users->delete($user)) {
                $this->Flash->success(__('Utilisateur supprimé.'));
            } else {
                $this->Flash->error(__('Utilisateur inconnu.'));
            }
    
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Vous ne pouvez pas supprimer ce compte, contactez l\'administrateur pour en savoir plus.'));
        return $this->redirect(['action' => 'index']);
    }
}
