<?php

namespace App\Http\Livewire;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Create extends Component implements HasForms
{

    use InteractsWithForms;

    public Model $model;

    public function mount(): void
    {
        $fields = $this->model->getFillable();
        $fields = array_flip($fields);
        $fields = data_set($fields, '*', 'adww');
        $this->form->fill($fields);
        
    }

    protected function getFormSchema(): array 
    {
        dd($this->__get('name'));
        return [
            TextInput::make('name')->required(),
            // Forms\Components\MarkdownEditor::make('content'),
        ];
    } 

    public function render()
    {
        return view('livewire.create');
    }
}
