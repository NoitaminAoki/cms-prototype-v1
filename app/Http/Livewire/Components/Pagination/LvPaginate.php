<?php

namespace App\Http\Livewire\Components\Pagination;

use Livewire\Component;

class LvPaginate extends Component
{
    public $startPage;
    public $endPage;
    public $currentPage;
    public $totalPage = 10;
    public $offset = 0;
    public $limit = 10;
    public $pageAttributes = [
        'total_data' => 0,
        'offset' => 0,
        'limit' => 0,
        'current_page' => 1,
    ];
    
    public $tester;
    
    public function render()
    {
        $this->currentPage = $this->pageAttributes['current_page'];
        $this->startPage = ($this->currentPage < 4)? 1 : $this->currentPage - 1;
        $this->endPage = 2 + $this->startPage;
        $this->endPage = ($this->totalPage < $this->endPage) ? $this->totalPage : $this->endPage;
        $diff = $this->startPage - $this->endPage + 2;
        $this->startPage -= ($this->startPage - $diff > 0) ? $diff : 0;
        
        return view('livewire.components.pagination.lv-paginate');
    }
    
    public function goToPage($page)
    {
        if($page < 1) {
            $page = 1;
        }
        $this->pageAttributes['current_page'] = $page;
    }
    
    public function convertPage()
    {
        $limit = $this->limit;
        $total_data = $this->total_data;
        $total_page = Converter::totalPage($total_data, $limit);
        $this->total_permission_page = $total_page;
        $this->offset_permission = Converter::pageToOffset($this->permission_page, $limit);
    }
}
