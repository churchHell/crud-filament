<?php

namespace App\Http\Livewire;

use Filament\Forms\Components\Concerns\CanBeInline;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Create extends Component implements HasForms
{

    use InteractsWithForms;

    public Model $model;
    public array $fields = [];
    public array $relations = [];
    public array $types = [];

    public function mount(): void
    {
        $this->fields = array_merge($this->model->getFillable(), $this->fields);    
        $this->form->fill();  
    }

    protected function getFormSchema(): array 
    {
        $fields = [];
        foreach($this->fields as $field){
            $className = data_get($this->types, $field, 'TextInput');
            $fullClassName = 'Filament\Forms\Components\\' . $className;
            $instance = $fullClassName::make($field)->label(__($field));
            if(in_array(CanBeInline::class, class_uses($fullClassName), true)){
                $instance = $instance->inline(false);
            }
            if(in_array($className, ['BelongsToSelect', 'BelongsToManyMultiSelect'], true)){
                $relation = data_get($this->relations, $field, ['', '']);
                $instance = $instance->preload()->relationship($relation[0], $relation[1]);
                if(in_array($className, ['BelongsToSelect'], true)){
                    $instance = $instance->searchable();
                }
            }
            if(in_array($className, ['Repeater'], true)){
                $relation = data_get($this->relations, $field, ['', '']);
                $instance = $instance
                    ->schema([
                        Select::make('role')
                            ->options([
                                'member' => 'Member',
                                'administrator' => 'Administrator',
                                'owner' => 'Owner',
                            ]),
                            TextInput::make('name')
                        ]);
                    // ->relationship($relation[0]);
            }
            $fields[] = $instance;
        }
        return $fields;
    } 

    protected function getFormModel(): Model 
    {
        return $this->model;
    }

    public function create (): void
    {
        dd($this->form->getState());
    }

    public function render()
    {
        return view('livewire.create');
    }
}
