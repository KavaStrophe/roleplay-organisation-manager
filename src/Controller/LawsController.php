<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Laws Controller
 *
 * @property \App\Model\Table\LawsTable $Laws
 *
 * @method \App\Model\Entity\Law[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LawsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Constitutions']
        ];
        $laws = $this->paginate($this->Laws);

        $this->set(compact('laws'));
    }

    /**
     * View method
     *
     * @param string|null $id Law id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $law = $this->Laws->get($id, [
            'contain' => ['Constitutions', 'Investigations']
        ]);

        $this->set('law', $law);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $law = $this->Laws->newEntity();
        if ($this->request->is('post')) {
            $law = $this->Laws->patchEntity($law, $this->request->getData());
            if ($this->Laws->save($law)) {
                $this->Flash->success(__('The law has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The law could not be saved. Please, try again.'));
        }
        $constitutions = $this->Laws->Constitutions->find('list', ['limit' => 200]);
        $investigations = $this->Laws->Investigations->find('list', ['limit' => 200]);
        $this->set(compact('law', 'constitutions', 'investigations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Law id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $law = $this->Laws->get($id, [
            'contain' => ['Investigations']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $law = $this->Laws->patchEntity($law, $this->request->getData());
            if ($this->Laws->save($law)) {
                $this->Flash->success(__('The law has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The law could not be saved. Please, try again.'));
        }
        $constitutions = $this->Laws->Constitutions->find('list', ['limit' => 200]);
        $investigations = $this->Laws->Investigations->find('list', ['limit' => 200]);
        $this->set(compact('law', 'constitutions', 'investigations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Law id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $law = $this->Laws->get($id);
        if ($this->Laws->delete($law)) {
            $this->Flash->success(__('The law has been deleted.'));
        } else {
            $this->Flash->error(__('The law could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
