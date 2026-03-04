<?php

namespace App\Traits;

trait ToastrTrait
{
    public function toastrSuccess(string $message, string $title = 'Success'): void
    {
        session()->flash('toastr', [
            'type' => 'success',
            'title' => $title,
            'message' => $message,
        ]);
    }

    public function toastrWarning(string $message, string $title = 'Warning'): void
    {
        session()->flash('toastr', [
            'type' => 'warning',
            'title' => $title,
            'message' => $message,
        ]);
    }

     public function toastrInfo($message, $title = 'Info')
    {
        session()->flash('toastr', [
            'type' => 'info',
            'message' => $message,
            'title' => $title,
        ]);
    }

    public function toastrError(string $message, string $title = 'Error'): void
    {
        session()->flash('toastr', [
            'type' => 'error',
            'title' => $title,
            'message' => $message,
        ]);
    }

}
