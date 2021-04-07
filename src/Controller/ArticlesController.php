<?php
namespace App\Controller;

class ArticlesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
    }
    public function index()
    {
        $articles = $this->Paginator->paginate($this->Articles->find());
        $this->set(compact('articles'));
    }
    public function add()
    {
        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $article->user_id = 1;
            if ($this->Articles->save($article)) {
                $this->Flash->success('Your Article has Been Saved');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Unable to Add Your Article');
        }
        $this->set('article', $article);
    }
    public function edit($slug)
    {
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success("Your Article Has been Updated Successfully");
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error("Unable to Update Your Article");
        }
        $this->set('article', $article);
    }
    public function delete($slug)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        if ($this->Articles->delete($article)) {
             $this->Flash->success("Your Article Has been Deleted Successfully ".$article->title);
                return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error("Unable to Delete Your Article");
        return $this->redirect(['action' => 'index']);
    }
    public function view($slug = null)
    {
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        $this->set(compact('article'));
    }
}
