<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;
    // public $comments;

    public $newComment;

    // public function mount()
    // {
    //     // $initialComments = Comment::latest()->paginate(1);
    //     // $this->comments = $initialComments;
    // }

    public function updated($field)
    {
        $this->validateOnly($field,['newComment' => 'required|max:255']);
    }

    public function addComment()
    {

        $this->validate(['newComment' => 'required']);
            
        $createdComment = Comment::create(['body' => $this->newComment,'user_id' => 1]);

        $this->newComment = '';
        session()->flash('message','Comment added successfully');
    }

    public function remove($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();
        session()->flash('message','Comment deleted successfully');
    }
    
    public function render()
    {
        return view('livewire.comments',[
            'comments' => Comment::latest()->paginate(2)
        ]);
    }

    public function paginationView()
    {
        return 'pagination-links';
    }
}
