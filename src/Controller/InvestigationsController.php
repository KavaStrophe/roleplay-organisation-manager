<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Investigations Controller
 *
 * @property \App\Model\Table\InvestigationsTable $Investigations
 *
 * @method \App\Model\Entity\Investigation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InvestigationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $investigations = $this->paginate($this->Investigations);

        $this->set(compact('investigations'));
    }

    /**
     * View method
     *
     * @param string|null $id Investigation id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $investigation = $this->Investigations->get($id, [
            'contain' => ['Laws']
        ]);

        $this->set('investigation', $investigation);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $investigation = $this->Investigations->newEntity();
        if ($this->request->is('post')) {
            $investigation = $this->Investigations->patchEntity($investigation, $this->request->getData());
            if ($this->Investigations->save($investigation)) {
                $this->Flash->success(__('The investigation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The investigation could not be saved. Please, try again.'));
        }
        $laws = $this->Investigations->Laws->find('list', ['limit' => 200]);
        $this->set(compact('investigation', 'laws'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Investigation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $investigation = $this->Investigations->get($id, [
            'contain' => ['Laws']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $investigation = $this->Investigations->patchEntity($investigation, $this->request->getData());
            if ($this->Investigations->save($investigation)) {
                $this->Flash->success(__('The investigation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The investigation could not be saved. Please, try again.'));
        }
        $laws = $this->Investigations->Laws->find('list', ['limit' => 200]);
        $this->set(compact('investigation', 'laws'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Investigation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $investigation = $this->Investigations->get($id);
        if ($this->Investigations->delete($investigation)) {
            $this->Flash->success(__('The investigation has been deleted.'));
        } else {
            $this->Flash->error(__('The investigation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
