<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TaskModel;
use App\Models\TaskStatusEnum;

class TaskController extends BaseController
{
    public function store()
    {
        $this->validate($this->_ruleSet());
        $model = new TaskModel();

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $model->insert($data);

        return redirect()->to('/tasks')->with('success', 'Tarefa criada com sucesso!');
    }

    public function index()
    {
        $model = new TaskModel();

        $searchId = $this->request->getGet('search_id');

        if ($searchId) {
            $tasks = $model->where('id', $searchId)->paginate(10);
        } else {
            $tasks = $model->orderBy('id', 'asc')->paginate(10);
        }

        $data = [
            'tasks' => $tasks,
            'pager' => $model->pager,
            'search_id' => $searchId,
        ];

        return view('tasks/index', $data);
    }

    public function edit($id)
    {
        $model = new TaskModel();
        $task = $model->find($id);

        if (!$task) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Tarefa não encontrada');
        }

        return view('tasks/edit', ['task' => $task]);
    }

    public function update($id)
    {
        if (isset($_POST['delete'])) {
            return $this->delete($id);
        }

        $this->validate($this->_ruleSet());

        $model = new TaskModel();

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $model->update($id, $data);

        return redirect()->to('/tasks')->with('success', 'Tarefa atualizada com sucesso!');
    }

    public function delete($id) {
        $model = new TaskModel();
        $model->delete($id);

        return redirect()->to('/tasks')->with('success', 'Tarefa deletada com sucesso!');
    }

    public function _validateStatus($status): bool {
        return in_array($status, TaskStatusEnum::getValues());
    }
    public function _ruleSet() : array {
        return [
            'title' => 'required|max_length[255]',
            'description' => 'required',
            'status' => [
                'required',
                [$this, '_validateStatus']
            ],
        ];
    }
}
