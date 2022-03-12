<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ModelObserver
{
    public function created(Model $model): void
    {
        Log::info($this->getMessage($model, 'created'), $this->info($model));
    }

    //public function updated(Model $model): void
    //{
        //Log::info($this->getMessage($model, 'updated'), $this->info($model));
    //}
    
    public function info(Model $model): array
    {
        return [
            'model_id' => $model->getKey(),
            'user_id' => auth()->id()
        ];
    }

    public function getMessage(Model $model, string $type): string
    {
        return trans('logs.messages.' . $type, ['model' => get_class($model)]);
    }
}
