<?php
  
  namespace App;

  use App\Invoice;
  use Illuminate\Contracts\View\View;
  use Maatwebsite\Excel\Concerns\FromView;
  
  class InvoicesExport implements FromView
  {
      public function view(): View
      {
          return view('usersExport', [
              'user' => User::all()
          ]);
      }
  }