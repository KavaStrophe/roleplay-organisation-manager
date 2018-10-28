<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Implications Controller
 *
 * @property \App\Model\Table\ImplicationsTable $Implications
 *
 * @method \App\Model\Entity\Implication[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ImplicationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Investigations', 'Characters']
        ];
        $implications = $this->paginate($this->Implications);

        $this->set(compact('implications'));
    }

    /**
     * View method
     *
     * @param string|null $id Implication id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $implication = $this->Implications->get($id, [
            'contain' => ['Investigations', 'Characters']
        ]);

        $this->set('implication', $implication);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $implication = $this->Implications->newEntity();
        if ($this->request->is('post')) {
            $implication = $this->Implications->patchEntity($implication, $this->request->getData());
            if ($this->Implications->save($implication)) {
                $this->Flash->success(__('The implication has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The implication could not be saved. Please, try again.'));
        }
        $investigations = $this->Implications->Investigations->find('list', ['limit' => 200]);
        $characters = $this->Implications->Characters->find('list', ['limit' => 200]);
        $this->set(compact('implication', 'investigations', 'characters'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Implication id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $implication = $this->Implications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $implication = $this->Implications->patchEntity($implication, $this->request->getData());
            if ($this->Implications->save($implication)) {
                $this->Flash->success(__('The implication has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The implication could not be saved. Please, try again.'));
        }
        $investigations = $this->Implications->Investigations->find('list', ['limit' => 200]);
        $characters = $this->Implications->Characters->find('list', ['limit' => 200]);
        $this->set(compact('implication', 'investigations', 'characters'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Implication id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $implication = $this->Implications->get($id);
        if ($this->Implications->delete($implication)) {
            $this->Flash->success(__('The implication has been deleted.'));
        } else {
            $this->Flash->error(__('The implication could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
