<?php

namespace App\Livewire;

use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class VisitorHistory extends Component
{
    use WithPagination;

    public $filterDate;

    protected $queryString = [
        'filterDate' => ['except' => ''],
    ];

    public function search()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['filterDate']);
        $this->resetPage();
    }

    public function render()
    {
        $memberId = Auth::guard('member')->id();

        $query = Visitor::where('member_id', $memberId);

        if ($this->filterDate) {
            $query->whereDate('visit_date', $this->filterDate);
        }

        $history = $query->latest('visit_date')->paginate(10);

        return view('livewire.visitor-history', [
            'history' => $history,
        ]);
    }
}
