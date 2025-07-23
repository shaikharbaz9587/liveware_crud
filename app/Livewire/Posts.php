<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

class Posts extends Component
{
    use WithPagination;

    public $title, $body, $post_id;
    public $isOpen = false;
    public $search = ''; // Add search property

    protected $rules = [
        'title' => 'required|string|min:3|max:255',
        'body' => 'required|string|min:10',
    ];

    public function render()
    {
      return view('livewire.posts', [
            'posts' => Post::query()
                ->when($this->search, function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                          ->orWhere('body', 'like', '%' . $this->search . '%');
                })
                ->paginate(5),
        ])->layout('layouts.app');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate();

        Post::create([
            'title' => $this->title,
            'body' => $this->body,
        ]);

        session()->flash('message', 'Post created successfully.');
        $this->closeModal();
        $this->resetInputFields();
        $this->resetPage();
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->title = $post->title;
        $this->body = $post->body;
        $this->openModal();
    }

    public function update()
    {
        $this->validate();

        $post = Post::findOrFail($this->post_id);
        $post->update([
            'title' => $this->title,
            'body' => $this->body,
        ]);

        session()->flash('message', 'Post updated successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Post::findOrFail($id)->delete();
        session()->flash('message', 'Post deleted successfully.');
        $this->resetPage();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->body = '';
        $this->post_id = null;
                $this->search = ''; // Reset search input after create/update

    }
}