<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Constitutions Controller
 *
 * @property \App\Model\Table\ConstitutionsTable $Constitutions
 *
 * @method \App\Model\Entity\Constitution[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConstitutionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Organizations']
        ];
        $constitutions = $this->paginate($this->Constitutions);

        $this->set(compact('constitutions'));
    }

    /**
     * View method
     *
     * @param string|null $id Constitution id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $constitution = $this->Constitutions->get($id, [
            'contain' => ['Users', 'Organizations']
        ]);

        $this->set('constitution', $constitution);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $constitution = $this->Constitutions->newEntity();
        if ($this->request->is('post')) {
            $constitution = $this->Constitutions->patchEntity($constitution, $this->request->getData());
            if ($this->Constitutions->save($constitution)) {
                $this->Flash->success(__('The constitution has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The constitution could not be saved. Please, try again.'));
        }
        $users = $this->Constitutions->Users->find('list', ['limit' => 200]);
        $organizations = $this->Constitutions->Organizations->find('list', ['limit' => 200]);
        $this->set(compact('constitution', 'users', 'organizations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Constitution id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $constitution = $this->Constitutions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $constitution = $this->Constitutions->patchEntity($constitution, $this->request->getData());
            if ($this->Constitutions->save($constitution)) {
                $this->Flash->success(__('The constitution has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The constitution could not be saved. Please, try again.'));
        }
        $users = $this->Constitutions->Users->find('list', ['limit' => 200]);
        $organizations = $this->Constitutions->Organizations->find('list', ['limit' => 200]);
        $this->set(compact('constitution', 'users', 'organizations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Constitution id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $constitution = $this->Constitutions->get($id);
        if ($this->Constitutions->delete($constitution)) {
            $this->Flash->success(__('The constitution has been deleted.'));
        } else {
            $this->Flash->error(__('The constitution could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
