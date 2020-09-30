<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Comments extends Component
{
    use WithPagination,WithFileUploads;

    // public $comments;

    public $newComment;

    public $image;

    public $ticketId = 1;

    // public function mount()
    // {
    //     // $initialComments = Comment::latest()->paginate(1);
    //     // $this->comments = $initialComments;
    // }
    protected $listeners = [
        'ticketSelected'
    ];

    public function ticketSelected($ticketId)
    {
        $this->ticketId = $ticketId;
    }

    public function updated($field)
    {
        $this->validateOnly($field,['newComment' => 'required|max:255']);
    }

    public function addComment()
    {

        $this->validate(['newComment' => 'required']);
            
        $createdComment = Comment::create([
            'body' => $this->newComment,
            'user_id' => 1,
            'support_ticket_id' => $this->ticketId 
        ]);

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
            'comments' => Comment::where('support_ticket_id',$this->ticketId)->latest()->paginate(2)
        ]);
    }

    public function paginationView()
    {
        return 'pagination-links';
    }
}
