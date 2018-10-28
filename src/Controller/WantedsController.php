<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Wanteds Controller
 *
 * @property \App\Model\Table\WantedsTable $Wanteds
 *
 * @method \App\Model\Entity\Wanted[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WantedsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Organizations', 'Investigations']
        ];
        $wanteds = $this->paginate($this->Wanteds);

        $this->set(compact('wanteds'));
    }

    /**
     * View method
     *
     * @param string|null $id Wanted id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $wanted = $this->Wanteds->get($id, [
            'contain' => ['Organizations', 'Investigations', 'Characters']
        ]);

        $this->set('wanted', $wanted);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $wanted = $this->Wanteds->newEntity();
        if ($this->request->is('post')) {
            $wanted = $this->Wanteds->patchEntity($wanted, $this->request->getData());
            if ($this->Wanteds->save($wanted)) {
                $this->Flash->success(__('The wanted has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The wanted could not be saved. Please, try again.'));
        }
        $organizations = $this->Wanteds->Organizations->find('list', ['limit' => 200]);
        $investigations = $this->Wanteds->Investigations->find('list', ['limit' => 200]);
        $characters = $this->Wanteds->Characters->find('list', ['limit' => 200]);
        $this->set(compact('wanted', 'organizations', 'investigations', 'characters'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Wanted id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $wanted = $this->Wanteds->get($id, [
            'contain' => ['Characters']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $wanted = $this->Wanteds->patchEntity($wanted, $this->request->getData());
            if ($this->Wanteds->save($wanted)) {
                $this->Flash->success(__('The wanted has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The wanted could not be saved. Please, try again.'));
        }
        $organizations = $this->Wanteds->Organizations->find('list', ['limit' => 200]);
        $investigations = $this->Wanteds->Investigations->find('list', ['limit' => 200]);
        $characters = $this->Wanteds->Characters->find('list', ['limit' => 200]);
        $this->set(compact('wanted', 'organizations', 'investigations', 'characters'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Wanted id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $wanted = $this->Wanteds->get($id);
        if ($this->Wanteds->delete($wanted)) {
            $this->Flash->success(__('The wanted has been deleted.'));
        } else {
            $this->Flash->error(__('The wanted could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
